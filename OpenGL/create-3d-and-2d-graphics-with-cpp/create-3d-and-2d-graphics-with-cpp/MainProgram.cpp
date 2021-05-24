#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>

#include "MainProgram.h"
#include "Texture.h"

int runMain()
{
	//// Vertices coordinates
	//GLfloat vertices[] =
	//{ //     COORDINATES     /        COLORS      /   TexCoord  //
	//	-0.5f, -0.5f, 0.0f,     1.0f, 0.0f, 0.0f,	0.0f, 0.0f, // Lower left corner
	//	-0.5f,  0.5f, 0.0f,     0.0f, 1.0f, 0.0f,	0.0f, 3.0f, // Upper left corner
	//	 0.5f,  0.5f, 0.0f,     0.0f, 0.0f, 1.0f,	3.0f, 3.0f, // Upper right corner
	//	 0.5f, -0.5f, 0.0f,     1.0f, 1.0f, 1.0f,	3.0f, 0.0f  // Lower right corner
	//};

	//// Indices for vertices order
	//GLuint indices[] =
	//{
	//	0, 2, 1, // Upper triangle
	//	0, 3, 2 // Lower triangle
	//};

	// Vertices coordinates
	GLfloat vertices[] =
	{ //     COORDINATES     /        COLORS      /   TexCoord  //
		-0.5f, -0.5f, 0.0f,     1.0f, 0.0f, 0.0f,	-1.0f, -1.0f, // Lower left corner
		 0.0f,  0.5f, 0.0f,     0.0f, 1.0f, 0.0f,	0.5f, 2.0f, // middle corner
		 0.5f, -0.5f, 0.0f,     0.0f, 0.0f, 1.0f,	2.0f, -1.0f // Upper right corner
	};

	// Indices for vertices order
	GLuint indices[] =
	{
		0, 1, 2
	};

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

	ShaderProgram shaderProgram("texture_default.vert", "texture_default.frag");

	GLuint scaleUniform = glGetUniformLocation(shaderProgram.ID, "scale");

	VertexArray vertexArray;
	vertexArray.Bind();

	VertexBuffer vertexBuffer(vertices, sizeof(vertices));
	vertexArray.LinkAttrib(vertexBuffer, 0, 3, GL_FLOAT, 8 * sizeof(float), nullptr);
	vertexArray.LinkAttrib(vertexBuffer, 1, 3, GL_FLOAT, 8 * sizeof(float), (void*)(3 * sizeof(float)));
	vertexArray.LinkAttrib(vertexBuffer, 2, 2, GL_FLOAT, 8 * sizeof(float), (void*)(6 * sizeof(float)));

	IndexBuffer indexBuffer(indices, sizeof(indices));

	vertexArray.Unbind();
	vertexBuffer.Unbind();
	indexBuffer.Unbind();

	Texture popCat("pop_cat.png", GL_TEXTURE_2D, GL_TEXTURE0, GL_RGBA, GL_UNSIGNED_BYTE);
	popCat.TexUnit(shaderProgram, "tex0", 0);

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT);

		shaderProgram.Activate();

		glUniform1f(scaleUniform, 1.0F);

		popCat.Bind();
		vertexArray.Bind();
		glDrawElements(GL_TRIANGLES, 6, GL_UNSIGNED_INT, nullptr);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}

	vertexArray.Delete();
	vertexBuffer.Delete();
	indexBuffer.Delete();
	popCat.Delete();
	shaderProgram.Delete();

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}