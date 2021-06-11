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

	void Draw(ShaderProgram& shader, Camera& camera);
};