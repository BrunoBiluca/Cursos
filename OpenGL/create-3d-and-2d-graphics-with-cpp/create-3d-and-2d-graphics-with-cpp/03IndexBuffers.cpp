#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>

#include "03IndexBuffers.h"
#include "02Triangles.h"
#include "ShaderProgram.h"
#include "VertexArray.h"
#include "IndexBuffer.h"


// Triangle
GLfloat vertices[] = {
	-0.5f, -0.5f * float(sqrt(3)) / 3, 0.0f, // Lower left corner
	0.5f, -0.5f * float(sqrt(3)) / 3, 0.0f, // Lower right corner
	0.0f, 0.5f * float(sqrt(3)) * 2 / 3, 0.0f, // Upper corner
	-0.5f / 2, 0.5f * float(sqrt(3)) / 6, 0.0f, // Inner left
	0.5f / 2, 0.5f * float(sqrt(3)) / 6, 0.0f, // Inner right
	0.0f, -0.5f * float(sqrt(3)) / 3, 0.0f // Inner down
};

GLuint indices[] =
{
	0, 3, 5, // Lower left triangle
	3, 2, 4, // Lower right triangle
	5, 4, 1 // Upper triangle
};


int run03()
{
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

	ShaderProgram shaderProgram("default.vert", "default.frag");

	VertexArray vertexArray;
	vertexArray.Bind();

	VertexBuffer vertexBuffer(vertices, sizeof(vertices));
	vertexArray.LinkVBO(vertexBuffer, 0);

	IndexBuffer indexBuffer(indices, sizeof(indices));

	vertexArray.Unbind();
	vertexBuffer.Unbind();
	indexBuffer.Unbind();

	SceneLoop2(window, shaderProgram, vertexArray);

	vertexArray.Delete();
	vertexBuffer.Delete();
	indexBuffer.Delete();
	shaderProgram.Delete();


	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}

void SceneLoop2(GLFWwindow* window, ShaderProgram shaderProgram, VertexArray VAO)
{

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT);
		shaderProgram.Activate();
		VAO.Bind();
		glDrawElements(GL_TRIANGLES, 9, GL_UNSIGNED_INT, 0);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}
}