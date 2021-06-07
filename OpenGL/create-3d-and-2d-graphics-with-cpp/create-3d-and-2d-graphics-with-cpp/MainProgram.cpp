#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>
#include<glm/glm.hpp>
#include<glm/gtc/matrix_transform.hpp>
#include<glm/gtc/type_ptr.hpp>

#include "MainProgram.h"
#include "Texture.h"
#include "TextureBuilder.cpp"
#include "Camera.h"
#include "CameraMovement.h"

int runMain()
{
	const unsigned int width = 800;
	const unsigned int height = 800;

	// Vertices coordinates
	GLfloat vertices[] =
	{ //     COORDINATES     /        COLORS          /    TexCoord   /        NORMALS       //
		-0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f, 	 0.0f, 0.0f,   0.0f, -1.0f, 0.0f, // Bottom side
		-0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 0.0f, 5.0f,   0.0f, -1.0f, 0.0f, // Bottom side
		 0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 5.0f,   0.0f, -1.0f, 0.0f, // Bottom side
		 0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 0.0f,   0.0f, -1.0f, 0.0f, // Bottom side

		-0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f, 	 0.0f, 0.0f,  -0.8f, 0.5f,  0.0f, // Left Side
		-0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 0.0f,  -0.8f, 0.5f,  0.0f, // Left Side
		 0.0f, 0.8f,  0.0f,   0.92f, 0.86f, 0.76f,	 2.5f, 5.0f,  -0.8f, 0.5f,  0.0f, // Left Side

		-0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 0.0f,   0.0f, 0.5f, -0.8f, // Non-facing side
		 0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 0.0f, 0.0f,   0.0f, 0.5f, -0.8f, // Non-facing side
		 0.0f, 0.8f,  0.0f,   0.92f, 0.86f, 0.76f,	 2.5f, 5.0f,   0.0f, 0.5f, -0.8f, // Non-facing side

		 0.5f, 0.0f, -0.5f,   0.83f, 0.70f, 0.44f,	 0.0f, 0.0f,   0.8f, 0.5f,  0.0f, // Right side
		 0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 0.0f,   0.8f, 0.5f,  0.0f, // Right side
		 0.0f, 0.8f,  0.0f,   0.92f, 0.86f, 0.76f,	 2.5f, 5.0f,   0.8f, 0.5f,  0.0f, // Right side

		 0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f,	 5.0f, 0.0f,   0.0f, 0.5f,  0.8f, // Facing side
		-0.5f, 0.0f,  0.5f,   0.83f, 0.70f, 0.44f, 	 0.0f, 0.0f,   0.0f, 0.5f,  0.8f, // Facing side
		 0.0f, 0.8f,  0.0f,   0.92f, 0.86f, 0.76f,	 2.5f, 5.0f,   0.0f, 0.5f,  0.8f  // Facing side
	};

	// Indices for vertices order
	GLuint indices[] =
	{
		0, 1, 2, // Bottom side
		0, 2, 3, // Bottom side
		4, 6, 5, // Left side
		7, 9, 8, // Non-facing side
		10, 12, 11, // Right side
		13, 15, 14 // Facing side
	};

	GLfloat lightVertices[] =
	{ //     COORDINATES     //
		-0.1f, -0.1f,  1.1f,
		-0.1f, -0.1f,  0.9f,
		 0.1f, -0.1f,  0.9f,
		 0.1f, -0.1f,  1.1f,
		-0.1f,  0.1f,  1.1f,
		-0.1f,  0.1f,  0.9f,
		 0.1f,  0.1f,  0.9f,
		 0.1f,  0.1f,  1.1f
	};

	GLuint lightIndices[] =
	{
		0, 1, 2,
		0, 2, 3,
		0, 4, 7,
		0, 7, 3,
		3, 7, 6,
		3, 6, 2,
		2, 6, 5,
		2, 5, 1,
		1, 5, 4,
		1, 4, 0,
		4, 5, 6,
		4, 6, 7
	};

	glfwInit();

	glfwWindowHint(GLFW_CONTEXT_VERSION_MAJOR, 3);
	glfwWindowHint(GLFW_CONTEXT_VERSION_MINOR, 3);
	glfwWindowHint(GLFW_OPENGL_PROFILE, GLFW_OPENGL_CORE_PROFILE);

	GLFWwindow* window = CreateWindow();
	if (window == nullptr)
	{
		glfwTerminate();
		return -1;
	}

	// Cria o triângulo com textura
	ShaderProgram shaderProgram("light_shader.vert", "light_color.frag");

	GLuint scaleUniform = glGetUniformLocation(shaderProgram.ID, "scale");

	VertexArray vertexArray;
	vertexArray.Bind();

	VertexBuffer vertexBuffer(vertices, sizeof(vertices));
	vertexArray.LinkAttribFloat(vertexBuffer, 0, 3, GL_FLOAT, 11, 0);
	vertexArray.LinkAttribFloat(vertexBuffer, 1, 3, GL_FLOAT, 11, 3);
	vertexArray.LinkAttribFloat(vertexBuffer, 2, 2, GL_FLOAT, 11, 6);
	vertexArray.LinkAttribFloat(vertexBuffer, 3, 3, GL_FLOAT, 11, 8);

	IndexBuffer indexBuffer(indices, sizeof(indices));

	vertexArray.Unbind();
	vertexBuffer.Unbind();
	indexBuffer.Unbind();

	TextureBuilder popCat("brick.png", GL_TEXTURE_2D, GL_TEXTURE0);
	popCat.Format(GL_RGBA, GL_UNSIGNED_BYTE)
		.Repeat()
		.Build();
	popCat.TexUnit(shaderProgram, "tex0", 0);

	// Cria a fonte de luz
	ShaderProgram lightShaderProgram("light.vert", "light.frag");

	VertexArray lightVAO;
	lightVAO.Bind();

	VertexBuffer lightVBO(lightVertices, sizeof(lightVertices));

	IndexBuffer lightEBO(lightIndices, sizeof(lightIndices));

	lightVAO.LinkAttrib(lightVBO, 0, 3, GL_FLOAT, 3 * sizeof(float), nullptr);

	lightVAO.Unbind();
	lightVBO.Unbind();
	lightEBO.Unbind();

	// Configura estado da fonte de luz
	glm::vec4 lightColor = glm::vec4(1.0f, 1.0f, 1.0f, 1.0f);
	glm::vec3 lightPos = glm::vec3(0.5f, 0.5f, 0.5f);
	glm::mat4 lightModel = glm::mat4(1.0f);
	lightModel = glm::translate(lightModel, lightPos);
	lightShaderProgram.Activate();
	glUniformMatrix4fv(
		glGetUniformLocation(lightShaderProgram.ID, "model"), 1, GL_FALSE, glm::value_ptr(lightModel)
	);
	glUniform4f(
		glGetUniformLocation(lightShaderProgram.ID, "lightColor"),
		lightColor.x, lightColor.y, lightColor.z, lightColor.w
	);

	// Configura a pirâmide
	glm::vec3 pyramidPos = glm::vec3(0.0f, 0.0f, 0.0f);
	glm::mat4 pyramidModel = glm::mat4(1.0f);
	pyramidModel = glm::translate(pyramidModel, pyramidPos);
	
	shaderProgram.Activate();
	glUniformMatrix4fv(
		glGetUniformLocation(shaderProgram.ID, "model"), 1, GL_FALSE, glm::value_ptr(pyramidModel)
	);
	glUniform4f(
		glGetUniformLocation(shaderProgram.ID, "lightColor"), 
		lightColor.x, lightColor.y, lightColor.z, lightColor.w
	);
	glUniform3f(
		glGetUniformLocation(shaderProgram.ID, "lightPos"), 
		lightPos.x, lightPos.y, lightPos.z
	);

	Camera camera(width, height, glm::vec3(0.0f, 0.3f, 2.0f));
	CameraMovement movement;

	glEnable(GL_DEPTH_TEST);

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

		movement.Inputs(window, camera);
		camera.SetupPerspectiveView(45.0f, 0.1f, 100.0f);

		// Ativa o shader program da pirâmide
		shaderProgram.Activate();
		glUniform3f(
			glGetUniformLocation(shaderProgram.ID, "camPos"), 
			camera.Position.x, camera.Position.y, camera.Position.z
		);
		glUniform1f(scaleUniform, 1.0F);

		camera.ExportMatrix(shaderProgram, "camMatrix");
		popCat.Bind();
		vertexArray.Bind();
		glDrawElements(GL_TRIANGLES, sizeof(indices) / sizeof(int), GL_UNSIGNED_INT, nullptr);

		// Ativa o shader program da fonte de luz
		lightShaderProgram.Activate();
		camera.ExportMatrix(lightShaderProgram, "camMatrix");
		lightVAO.Bind();
		glDrawElements(GL_TRIANGLES, sizeof(lightIndices) / sizeof(int), GL_UNSIGNED_INT, nullptr);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}

	vertexArray.Delete();
	vertexBuffer.Delete();
	indexBuffer.Delete();
	popCat.Delete();
	shaderProgram.Delete();

	lightVAO.Delete();
	lightVBO.Delete();
	lightEBO.Delete();
	lightShaderProgram.Delete();

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}