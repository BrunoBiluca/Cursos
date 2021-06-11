#pragma once

#include<glm/glm.hpp>
#include<glad/glad.h>
#include <vector>


struct Vertex
{
	glm::vec3 position;
	glm::vec3 normal;
	glm::vec3 color;
	glm::vec2 texUV;
};

class VertexBuffer
{
public:
	GLuint ID;
	VertexBuffer(std::vector<Vertex>& vertices);

	void Bind();
	void Unbind();
	void Delete();
};