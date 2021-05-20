#ifndef VERTEX_ARRAY_CLASS_H
#define VERTEX_ARRAY_CLASS_H

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
	void Bind();
	void Unbind();
	void Delete();
};
#endif