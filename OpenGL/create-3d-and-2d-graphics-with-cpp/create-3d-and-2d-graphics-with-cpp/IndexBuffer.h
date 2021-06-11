#pragma once

#include<glad/glad.h>
#include<vector>

class IndexBuffer
{
public:
	GLuint ID;
	explicit IndexBuffer(std::vector<GLuint>& indices);

	void Bind();
	void Unbind();
	void Delete();
};