#include"VertexArray.h"

VertexArray::VertexArray()
{
	glGenVertexArrays(1, &ID);
}

void VertexArray::LinkVBO(VertexBuffer& VBO, GLuint layout)
{
	VBO.Bind();
	glVertexAttribPointer(layout, 3, GL_FLOAT, GL_FALSE, 0, nullptr);
	glEnableVertexAttribArray(layout);
	VBO.Unbind();
}

void VertexArray::Bind()
{
	glBindVertexArray(ID);
}

void VertexArray::Unbind()
{
	glBindVertexArray(0);
}

void VertexArray::Delete()
{
	glDeleteVertexArrays(1, &ID);
}
