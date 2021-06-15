//------- Ignore this ----------
#include<filesystem>
namespace fs = std::filesystem;
//------------------------------

#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>
#include<glm/glm.hpp>
#include<glm/gtc/matrix_transform.hpp>
#include<glm/gtc/type_ptr.hpp>

#include "MainProgram.h"
#include "Mesh.h"
#include "CameraMovement.h"
#include "Model.h"

int runMain()
{
	const unsigned int width = 800;
	const unsigned int height = 800;

	// Vertices coordinates
	Vertex vertices[] =
	{
		Vertex{
			glm::vec3(-1.0f, 0.0f,  1.0f),
			glm::vec3(0.0f, 1.0f, 0.0f),
			glm::vec3(1.0f, 1.0f, 1.0f),
			glm::vec2(0.0f, 0.0f)
		},
		Vertex{
			glm::vec3(-1.0f, 0.0f, -1.0f), 
			glm::vec3(0.0f, 1.0f, 0.0f), 
			glm::vec3(1.0f, 1.0f, 1.0f), 
			glm::vec2(0.0f, 1.0f)
		},
		Vertex{
			glm::vec3(1.0f, 0.0f, -1.0f), 
			glm::vec3(0.0f, 1.0f, 0.0f), 
			glm::vec3(1.0f, 1.0f, 1.0f), 
			glm::vec2(1.0f, 1.0f)
		},
		Vertex{
			glm::vec3(1.0f, 0.0f,  1.0f), 
			glm::vec3(0.0f, 1.0f, 0.0f), 
			glm::vec3(1.0f, 1.0f, 1.0f), 
			glm::vec2(1.0f, 0.0f)
		}
	};

	// Indices for vertices order
	GLuint indices[] =
	{
		0, 1, 2,
		0, 2, 3
	};

	Vertex lightVertices[] =
	{ //     COORDINATES     //
		Vertex{glm::vec3(-0.1f, -0.1f,  0.1f)},
		Vertex{glm::vec3(-0.1f, -0.1f, -0.1f)},
		Vertex{glm::vec3(0.1f, -0.1f, -0.1f)},
		Vertex{glm::vec3(0.1f, -0.1f,  0.1f)},
		Vertex{glm::vec3(-0.1f,  0.1f,  0.1f)},
		Vertex{glm::vec3(-0.1f,  0.1f, -0.1f)},
		Vertex{glm::vec3(0.1f,  0.1f, -0.1f)},
		Vertex{glm::vec3(0.1f,  0.1f,  0.1f)}
	};

	GLuint lightIndices[] =
	{
		0, 1, 2,
		0, 2, 3,
		0, 4, 7,
		0, 7, 3,
		3, 7, 6,
		3, 6, 2,
		2, 6, 5,
		2, 5, 1,
		1, 5, 4,
		1, 4, 0,
		4, 5, 6,
		4, 6, 7
	};

	glfwInit();

	glfwWindowHint(GLFW_CONTEXT_VERSION_MAJOR, 3);
	glfwWindowHint(GLFW_CONTEXT_VERSION_MINOR, 3);
	glfwWindowHint(GLFW_OPENGL_PROFILE, GLFW_OPENGL_CORE_PROFILE);

	GLFWwindow* window = glfwCreateWindow(width, height, "YoutubeOpenGL", NULL, NULL);
	if (window == NULL)
	{
		std::cout << "Failed to create GLFW window" << std::endl;
		glfwTerminate();
		return -1;
	}
	glfwMakeContextCurrent(window);
	gladLoadGL();
	glViewport(0, 0, width, height);

	Camera camera(width, height, glm::vec3(0.0f, 0.3f, 2.0f));
	CameraMovement movement;

	ShaderProgram shaderProgram("model.vert", "point_light.frag");

	glm::vec4 lightColor = glm::vec4(1.0f, 1.0f, 1.0f, 1.0f);
	glm::vec3 lightPos = glm::vec3(0.5f, 0.5f, 0.5f);
	glm::mat4 lightModel = glm::mat4(1.0f);
	lightModel = glm::translate(lightModel, lightPos);

	shaderProgram.Activate();
	glUniform4f(
		glGetUniformLocation(shaderProgram.ID, "lightColor"), 
		lightColor.x, lightColor.y, lightColor.z, lightColor.w
	);
	glUniform3f(
		glGetUniformLocation(shaderProgram.ID, "lightPos"), 
		lightPos.x, lightPos.y, lightPos.z
	);

	std::string parentDir = (fs::current_path().fs::path::parent_path()).string();
	std::string modelPath = "/create-3d-and-2d-graphics-with-cpp/models/sword/scene.gltf";
	std::cout << (parentDir + modelPath).c_str() << std::endl;

	Model model((parentDir + modelPath).c_str());

	glEnable(GL_DEPTH_TEST);

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

		movement.Inputs(window, camera);
		camera.SetupPerspectiveView(45.0f, 0.1f, 100.0f);

		model.Draw(shaderProgram, camera);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}

	shaderProgram.Delete();

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}