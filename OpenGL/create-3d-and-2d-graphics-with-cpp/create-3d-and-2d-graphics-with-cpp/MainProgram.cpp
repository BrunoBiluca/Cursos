#include<iostream>
#include<glad/glad.h>
#include<GLFW/glfw3.h>
#include<glm/glm.hpp>
#include<glm/gtc/matrix_transform.hpp>
#include<glm/gtc/type_ptr.hpp>

#include "MainProgram.h"
#include "Mesh.h"
#include "CameraMovement.h"

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

	// Cria o triângulo com textura
	ShaderProgram shaderProgram("light_shader.vert", "point_light.frag");

	TextureBuilder textures[]
	{
		TextureBuilder("planks.png", "diffuse", 0).Format(GL_RGBA, GL_UNSIGNED_BYTE).Build(),
		TextureBuilder("planksSpec.png", "specular", 1).Format(GL_RED, GL_UNSIGNED_BYTE).Build()
	};

	std::vector<Vertex> verts(vertices, vertices + sizeof(vertices) / sizeof(Vertex));
	std::vector<GLuint> ind(indices, indices + sizeof(indices) / sizeof(GLuint));
	std::vector<TextureBuilder> tex(textures, textures + sizeof(textures) / sizeof(TextureBuilder));

	Mesh floor(verts, ind, tex);

	// Cria a fonte de luz
	ShaderProgram lightShaderProgram("light.vert", "light.frag");

	std::vector<Vertex> lightVerts(
		lightVertices, lightVertices + sizeof(lightVertices) / sizeof(Vertex)
	);
	std::vector<GLuint> lightInd(lightIndices, lightIndices + sizeof(lightIndices) / sizeof(GLuint));
	Mesh light(lightVerts, lightInd, tex);

	// Configura estado da fonte de luz
	glm::vec4 lightColor = glm::vec4(1.0f, 1.0f, 1.0f, 1.0f);
	glm::vec3 lightPos = glm::vec3(0.5f, 0.5f, 0.5f);
	glm::mat4 lightModel = glm::mat4(1.0f);
	lightModel = glm::translate(lightModel, lightPos);
	lightShaderProgram.Activate();
	glUniformMatrix4fv(
		glGetUniformLocation(lightShaderProgram.ID, "model"), 1, GL_FALSE, glm::value_ptr(lightModel)
	);
	glUniform4f(
		glGetUniformLocation(lightShaderProgram.ID, "lightColor"),
		lightColor.x, lightColor.y, lightColor.z, lightColor.w
	);

	// Configura a pirâmide
	glm::vec3 pyramidPos = glm::vec3(0.0f, 0.0f, 0.0f);
	glm::mat4 pyramidModel = glm::mat4(1.0f);
	pyramidModel = glm::translate(pyramidModel, pyramidPos);

	shaderProgram.Activate();
	glUniformMatrix4fv(
		glGetUniformLocation(shaderProgram.ID, "model"), 1, GL_FALSE, glm::value_ptr(pyramidModel)
	);
	glUniform4f(
		glGetUniformLocation(shaderProgram.ID, "lightColor"),
		lightColor.x, lightColor.y, lightColor.z, lightColor.w
	);
	glUniform3f(
		glGetUniformLocation(shaderProgram.ID, "lightPos"),
		lightPos.x, lightPos.y, lightPos.z
	);

	Camera camera(width, height, glm::vec3(0.0f, 0.3f, 2.0f));
	CameraMovement movement;

	glEnable(GL_DEPTH_TEST);

	while (!glfwWindowShouldClose(window))
	{
		glClearColor(0.07F, 0.13F, 0.17F, 1.0F);

		glClear(GL_COLOR_BUFFER_BIT | GL_DEPTH_BUFFER_BIT);

		movement.Inputs(window, camera);
		camera.SetupPerspectiveView(45.0f, 0.1f, 100.0f);

		floor.Draw(shaderProgram, camera);
		light.Draw(lightShaderProgram, camera);

		glfwSwapBuffers(window);
		glfwPollEvents();
	}

	shaderProgram.Delete();
	lightShaderProgram.Delete();

	glfwDestroyWindow(window);
	glfwTerminate();

	return 0;
}