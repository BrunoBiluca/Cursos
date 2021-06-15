#pragma once

#include<string>
#include<vector>

#include"VertexArray.h"
#include"IndexBuffer.h"
#include"Camera.h"
#include"TextureBuilder.cpp"


class Mesh
{
public:
	std::vector<Vertex> vertices;
	std::vector<GLuint> indices;
	std::vector<TextureBuilder> textures;

	VertexArray VAO;

	Mesh(
		std::vector<Vertex>& vertices,
		std::vector<GLuint>& indices,
		std::vector<TextureBuilder>& textures
	);

	void Draw(
		ShaderProgram& shader, 
		Camera& camera, 
		glm::mat4 matrix = glm::mat4(1.0f),
		glm::vec3 translation = glm::vec3(0.0f, 0.0f, 0.0f),
		glm::quat rotation = glm::quat(1.0f, 0.0f, 0.0f, 0.0f),
		glm::vec3 scale = glm::vec3(1.0f, 1.0f, 1.0f)
	);
};