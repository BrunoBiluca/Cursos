#pragma once

#include<glad/glad.h>
#include<GLFW/glfw3.h>
#include "Camera.h"

class CameraMovement
{
public:
	bool firstClick = true;
	float speed = 0.1f;
	float sensitivity = 100.0f;

	void Inputs(GLFWwindow* window, Camera& camera);

private:
	void HandleMovementSpeed(GLFWwindow* window);
	void HandleTranslation(GLFWwindow* window, Camera& camera);
	void HandleMouseInputs(GLFWwindow* window, Camera& camera);
};

