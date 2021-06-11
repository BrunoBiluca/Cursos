#include"Mesh.h"

Mesh::Mesh(
	std::vector<Vertex>& vertices,
	std::vector<GLuint>& indices,
	std::vector<TextureBuilder>& textures
)
{
	Mesh::vertices = vertices;
	Mesh::indices = indices;
	Mesh::textures = textures;

	VAO.Bind();

	VertexBuffer VBO(vertices);
	IndexBuffer EBO(indices);

	VAO.LinkAttrib(VBO, 0, 3, GL_FLOAT, sizeof(Vertex), nullptr);
	VAO.LinkAttrib(VBO, 1, 3, GL_FLOAT, sizeof(Vertex), (void*)(3 * sizeof(float)));
	VAO.LinkAttrib(VBO, 2, 3, GL_FLOAT, sizeof(Vertex), (void*)(6 * sizeof(float)));
	VAO.LinkAttrib(VBO, 3, 2, GL_FLOAT, sizeof(Vertex), (void*)(9 * sizeof(float)));

	VAO.Unbind();
	VBO.Unbind();
	EBO.Unbind();
}

void Mesh::Draw(ShaderProgram& shader, Camera& camera)
{
	// Bind shader to be able to access uniforms
	shader.Activate();
	VAO.Bind();

	// Keep track of how many of each type of textures we have
	unsigned int numDiffuse = 0;
	unsigned int numSpecular = 0;

	for (unsigned int i = 0; i < textures.size(); i++)
	{
		std::string num;
		std::string type = textures[i].textureType;
		if (type == "diffuse")
		{
			numDiffuse++;
			num = std::to_string(numDiffuse);
		}
		else if (type == "specular")
		{
			numSpecular++;
			num = std::to_string(numSpecular);
		}
		textures[i].TexUnit(shader, (type + num).c_str(), i);
		textures[i].Bind();
	}
	glUniform3f(
		glGetUniformLocation(shader.ID, "camPos"), 
		camera.Position.x, camera.Position.y, camera.Position.z
	);
	camera.ExportMatrix(shader, "camMatrix");

	glUniform1f(glGetUniformLocation(shader.ID, "scale"), 1.0F);

	glDrawElements(GL_TRIANGLES, indices.size(), GL_UNSIGNED_INT, nullptr);
}