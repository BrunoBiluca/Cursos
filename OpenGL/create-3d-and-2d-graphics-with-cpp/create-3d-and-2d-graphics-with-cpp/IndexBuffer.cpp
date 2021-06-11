#include "IndexBuffer.h"

IndexBuffer::IndexBuffer(std::vector<GLuint>& indices)
{
	glGenBuffers(1, &ID);
	glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, ID);
	glBufferData(
		GL_ELEMENT_ARRAY_BUFFER, 
		indices.size() * sizeof(GLuint), 
		indices.data(), 
		GL_STATIC_DRAW
	);
}

void IndexBuffer::Bind()
{
	glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, ID);
}

void IndexBuffer::Unbind()
{
	glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, 0);
}

void IndexBuffer::Delete()
{
	glDeleteBuffers(1, &ID);
}
