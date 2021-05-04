#include<iostream>
#include<algorithm>
#include<glad/glad.h>
#include<GLFW/glfw3.h>

[[nodiscard]] float normalize(float value, float min, float max)
{
	return value > max ? min : value;
}

int run01()
{
	// Inicializa o framework GLFW
	glfwInit();

	// Configura o framework
	glfwWindowHint(GLFW_CONTEXT_VERSION_MAJOR, 3);
	glfwWindowHint(GLFW_CONTEXT_VERSION_MINOR, 3);
	glfwWindowHint(GLFW_OPENGL_PROFILE, GLFW_OPENGL_CORE_PROFILE);

	GLFWwindow* window = glfwCreateWindow(800, 800, "Curso OpenGL", nullptr, nullptr);

	if (window == nullptr)
	{
		std::cout << "Failed to create GLFW window" << std::endl;
		glfwTerminate();
		return -1;
	}
	glfwMakeContextCurrent(window);

	gladLoadGL();
	glViewport(0, 0, 800, 800);

	double previousTime = glfwGetTime();
	std::cout << previousTime << std::endl;
	float red = 0.07F;
	float green = 0.13F;
	float blue = 0.17F;

	float angle = 0.0F;

	while (!glfwWindowShouldClose(window))
	{
		// Take care of all GLFW events, like resize window
		glfwPollEvents();

		if (double currTime = glfwGetTime(); currTime - previousTime > 0.1f)
		{
			angle += 0.1F;
			previousTime = currTime;

			//red = normalize(red * ((float)currTime), 0.07F, 255.0F);
			//green = normalize(green * ((float)currTime), 0.13F, 255.0F);
			//blue = normalize(blue * ((float)currTime), 0.17F, 255.0F);

			//std::cout 
			//	<< previousTime 
			//	<< " " << red 
			//	<< " " << green 
			//	<< " " << blue 
			//	<< std::endl;

		}

		glClearColor(float(sin(angle)), float(cos(angle)), float(tan(angle)), 1.0F);
		// Clear the back buffer assign the new color
		glClear(GL_COLOR_BUFFER_BIT);

		glfwSwapBuffers(window);
	}

	glfwDestroyWindow(window);

	glfwTerminate();

	return 0;
}