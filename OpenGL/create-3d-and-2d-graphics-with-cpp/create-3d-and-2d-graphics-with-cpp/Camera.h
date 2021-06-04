#pragma once

#include<glad/glad.h>
#include<GLFW/glfw3.h>
#include<glm/glm.hpp>
#include<glm/gtc/matrix_transform.hpp>
#include<glm/gtc/type_ptr.hpp>
#include<glm/gtx/rotate_vector.hpp>
#include<glm/gtx/vector_angle.hpp>

#include "ShaderProgram.h"

class Camera
{
public:
	int perspectiveWidth;
	int perspectiveHeight;

	glm::vec3 Position;
	glm::vec3 Orientation = glm::vec3(0.0f, 0.0f, -1.0f);
	glm::vec3 Up = glm::vec3(0.0f, 1.0f, 0.0f);

	// Camera constructor to set up initial values
	Camera(int width, int height, glm::vec3 position);

	// Updates and exports the camera matrix to the Vertex Shader
	void Matrix(
		float FOVdeg, 
		float nearPlane, 
		float farPlane, 
		ShaderProgram& shader, 
		const char* uniform
	);

	// Handles camera inputs
	void Inputs(GLFWwindow* window);
};

