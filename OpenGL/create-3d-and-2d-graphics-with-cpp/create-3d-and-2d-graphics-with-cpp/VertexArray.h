#pragma once

#include<glad/glad.h>
#include"VertexBuffer.h"

class VertexArray
{
public:
	GLuint ID;
	VertexArray();

	void LinkVBO(VertexBuffer& VBO, GLuint layout);
	void LinkAttrib(
		VertexBuffer& VBO,
		GLuint layout,
		GLuint numComponents,
		GLenum type,
		GLsizeiptr stride,
		void* offset
	);
	void LinkAttribFloat(VertexBuffer& VBO, GLuint layout, GLuint numComponents, GLenum type, GLsizeiptr stride, GLuint offset);
	void Bind();
	void Unbind();
	void Delete();
};