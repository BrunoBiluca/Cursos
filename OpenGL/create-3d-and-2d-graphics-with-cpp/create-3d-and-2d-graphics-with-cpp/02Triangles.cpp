#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>

#include "02Triangles.h"

// Vertex Shader source code
const char* vertexShaderSource = "#version 330 core\n"
"layout (location = 0) in vec3 aPos;\n"
"void main()\n"
"{\n"
"   gl_Position = vec4(aPos.x, aPos.y, aPos.z, 1.0);\n"
"}\0";

//Fragment Shader source code
const char* fragmentShaderSource = "#version 330 core\n"
"out vec4 FragColor;\n"
"void main()\n"
"{\n"
"   FragColor = vec4(0.8f, 0.3f, 0.02f, 1.0f);\n"
"}\n\0";

int run02()
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

	//// Right triangle
	//GLfloat vertices[] = {
	//	-0.5F, -0.5F * float(sqrt(3)) / 3, 0.0F, // Lower left corner
	//	0.5F, -0.5F * float(sqrt(3)) / 3, 0.0F, // Lower right corner
	//	-0.5F, 0.5F * float(sqrt(3)) * 2 / 3, 0.0F // Upper corner
	//};

	// Square
	//GLfloat vertices[] = {
	//	-0.5F, -0.5F, 0.0F, // Lower left corner
	//	0.5F, -0.5F, 0.0F, // Lower right corner
	//	-0.5F, 0.5F, 0.0F, // Upper left corner
	//	-0.5F, 0.5F, 0.0F, // Upper left corner
	//	0.5F, 0.5F, 0.0F, // Upper right corner
	//	0.5F, -0.5F, 0.0F // Lower right corner
	//};

	GLfloat vertices[] = {
		-0.5F, -0.5F, // Lower left corner
		0.5F, -0.5F, // Lower right corner
		0.5F, 0.5F, // Upper right corner
		-0.5F, 0.5F // Upper left corner
	};

	GLuint vertexArrayObject[1];
	GLuint vertexBufferObject[1];

	// Necess�rio garantir a ordem das chamadas de fun��es
	glGenVertexArrays(1, vertexArrayObject);
	glGenBuffers(1, vertexBufferObject);

	glBindVertexArray(vertexArrayObject[0]);

	glBindBuffer(GL_ARRAY_BUFFER, vertexBufferObject[0]);
	glBufferData(GL_ARRAY_BUFFER, sizeof(vertices), vertices, GL_STATIC_DRAW);

	// 2 coordinates (x, y)
	glVertexAttribPointer(0, 2, GL_FLOAT, GL_FALSE, 2 * sizeof(float), nullptr);

	// 3 coordinates (x, y, z)
	//glVertexAttribPointer(0, 3, GL_FLOAT, GL_FALSE, 3 * sizeof(float), nullptr);
	glEnableVertexAttribArray(0);

	glBindBuffer(GL_ARRAY_BUFFER, 0);
	glBindVertexArray(0);

	SceneLoop(window, shaderProgram, vertexArrayObject[0]);

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}

GLFWwindow* CreateWindow()
{
	GLFWwindow* window = glfwCreateWindow(800, 800, "Curso OpenGL", nullptr, nullptr);
	if (window == nullptr)
	{
		std::cout << "Failed to create GLFW window" << std::endl;
		return nullptr;
	}

	glfwMakeContextCurrent(window);

	gladLoadGL();
	glViewport(0, 0, 800, 800);
	return window;
}

void SceneLoop(GLFWwindow* window, GLuint shaderProgram, GLuint VAO)
{

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT);
		glUseProgram(shaderProgram);
		glBindVertexArray(VAO);
		//glDrawArrays(GL_TRIANGLES, 0, 3);
		//glDrawArrays(GL_TRIANGLES, 0, 6);
		glDrawArrays(GL_LINE_LOOP, 0, 4);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}
}

GLuint CreateShaderProgram()
{
	GLuint vertexShader = glCreateShader(GL_VERTEX_SHADER);
	glShaderSource(vertexShader, 1, &vertexShaderSource, nullptr);
	glCompileShader(vertexShader);

	GLuint fragmentShader = glCreateShader(GL_FRAGMENT_SHADER);
	glShaderSource(fragmentShader, 1, &fragmentShaderSource, nullptr);
	glCompileShader(fragmentShader);

	GLuint shaderProgram = glCreateProgram();
	glAttachShader(shaderProgram, vertexShader);
	glAttachShader(shaderProgram, fragmentShader);
	glLinkProgram(shaderProgram);

	glDeleteShader(vertexShader);
	glDeleteShader(fragmentShader);

	return shaderProgram;
}
