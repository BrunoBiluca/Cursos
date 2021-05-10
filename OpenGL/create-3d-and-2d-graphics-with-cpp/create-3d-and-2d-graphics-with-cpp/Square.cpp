#include"Square.h"

Square::Square()
{
	GLfloat v[] = {
		-0.5f, -0.5f, 0.0F, // Lower left corner
		0.5f, -0.5f, 0.0F, // Lower right corner
		-0.5f, 0.5f, 0.0F, // upper left corner
		0.5f, 0.5f, 0.0F // upper right corner
	};
	vertices = v;

	GLuint i[] = {
		0, 1, 2, // Lower left triangle
		2, 3, 1 // Lower right triangle
	};
	indices = i;
}
