#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>

#include "03IndexBuffers.h"
#include "02Triangles.h"

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

	GLuint shaderProgram = CreateShaderProgram();

	GLfloat vertices[] =
	{
		-0.5f, -0.5f * float(sqrt(3)) / 3, // Lower left corner
		0.5f, -0.5f * float(sqrt(3)) / 3, // Lower right corner
		0.0f, 0.5f * float(sqrt(3)) * 2 / 3, // Upper corner
		-0.5f / 2, 0.5f * float(sqrt(3)) / 6, // Inner left
		0.5f / 2, 0.5f * float(sqrt(3)) / 6, // Inner right
		0.0f, -0.5f * float(sqrt(3)) / 3 // Inner down
	};

	GLuint indices[] =
	{
		0, 3, 5, // Lower left triangle
		3, 2, 4, // Lower right triangle
		5, 4, 1 // Upper triangle
	};

	GLuint vertexArrayObject[1];	// VAO
	GLuint vertexBufferObject[1];	// VBO
	GLuint indexBufferObject;		// EBO

	// Necessário garantir a ordem das chamadas de funções
	glGenVertexArrays(1, vertexArrayObject);
	glGenBuffers(1, vertexBufferObject);
	glGenBuffers(1, &indexBufferObject);

	glBindVertexArray(vertexArrayObject[0]);

	// Set vertices data to buffer
	glBindBuffer(GL_ARRAY_BUFFER, vertexBufferObject[0]);
	glBufferData(GL_ARRAY_BUFFER, sizeof(vertices), vertices, GL_STATIC_DRAW);

	// Set indices data to buffer
	glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, indexBufferObject);
	glBufferData(GL_ELEMENT_ARRAY_BUFFER, sizeof(indices), indices, GL_STATIC_DRAW);

	// 2 coordinates (x, y)
	glVertexAttribPointer(0, 2, GL_FLOAT, GL_FALSE, 2 * sizeof(float), nullptr);
	glEnableVertexAttribArray(0);

	glBindBuffer(GL_ARRAY_BUFFER, 0);
	glBindVertexArray(0);


	glBindBuffer(GL_ELEMENT_ARRAY_BUFFER, 0);

	SceneLoop2(window, shaderProgram, vertexArrayObject[0]);

	glDeleteVertexArrays(1, vertexArrayObject);
	glDeleteBuffers(1, vertexBufferObject);
	glDeleteBuffers(1, &indexBufferObject);

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}

void SceneLoop2(GLFWwindow* window, GLuint shaderProgram, GLuint VAO)
{

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT);
		glUseProgram(shaderProgram);
		glBindVertexArray(VAO);
		glDrawElements(GL_TRIANGLES, 9, GL_UNSIGNED_INT, 0);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}
}