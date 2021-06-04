#include "CameraMovement.h"

void CameraMovement::Inputs(GLFWwindow* window, Camera& camera)
{
	// Handles key inputs
	HandleTranslation(window, camera);
	HandleMovementSpeed(window);
	HandleMouseInputs(window, camera);
}

void CameraMovement::HandleMouseInputs(GLFWwindow* window, Camera& camera)
{
	if (glfwGetMouseButton(window, GLFW_MOUSE_BUTTON_LEFT) == GLFW_RELEASE)
	{
		// Unhides cursor since camera is not looking around anymore
		glfwSetInputMode(window, GLFW_CURSOR, GLFW_CURSOR_NORMAL);
		firstClick = true;
		return;
	}

	if (glfwGetMouseButton(window, GLFW_MOUSE_BUTTON_LEFT) != GLFW_PRESS) return;

	glfwSetInputMode(window, GLFW_CURSOR, GLFW_CURSOR_HIDDEN);

	if (firstClick)
	{
		glfwSetCursorPos(window, (camera.perspectiveWidth / 2), (camera.perspectiveHeight / 2));
		firstClick = false;
	}

	double mouseX;
	double mouseY;
	glfwGetCursorPos(window, &mouseX, &mouseY);

	float rotX = sensitivity
		* (float)(mouseY - (camera.perspectiveHeight / 2)) / camera.perspectiveHeight;
	float rotY = sensitivity
		* (float)(mouseX - (camera.perspectiveWidth / 2)) / camera.perspectiveWidth;

	glm::vec3 newOrientation = glm::rotate(
		camera.Orientation,
		glm::radians(-rotX),
		glm::normalize(glm::cross(camera.Orientation, camera.Up))
	);

	if (abs(glm::angle(newOrientation, camera.Up) - glm::radians(90.0f)) <= glm::radians(85.0f))
	{
		camera.Orientation = newOrientation;
	}

	camera.Orientation = glm::rotate(camera.Orientation, glm::radians(-rotY), camera.Up);

	glfwSetCursorPos(window, (camera.perspectiveWidth / 2), (camera.perspectiveHeight / 2));
}

void CameraMovement::HandleMovementSpeed(GLFWwindow* window)
{
	if (glfwGetKey(window, GLFW_KEY_LEFT_SHIFT) == GLFW_PRESS)
	{
		speed = 0.4f;
	}
	else if (glfwGetKey(window, GLFW_KEY_LEFT_SHIFT) == GLFW_RELEASE)
	{
		speed = 0.1f;
	}
}

void CameraMovement::HandleTranslation(GLFWwindow* window, Camera& camera)
{
	if (glfwGetKey(window, GLFW_KEY_W) == GLFW_PRESS)
	{
		camera.Position += speed * camera.Orientation;
	}
	if (glfwGetKey(window, GLFW_KEY_A) == GLFW_PRESS)
	{
		camera.Position += speed * -glm::normalize(glm::cross(camera.Orientation, camera.Up));
	}
	if (glfwGetKey(window, GLFW_KEY_S) == GLFW_PRESS)
	{
		camera.Position += speed * -camera.Orientation;
	}
	if (glfwGetKey(window, GLFW_KEY_D) == GLFW_PRESS)
	{
		camera.Position += speed * glm::normalize(glm::cross(camera.Orientation, camera.Up));
	}
	if (glfwGetKey(window, GLFW_KEY_SPACE) == GLFW_PRESS)
	{
		camera.Position += speed * camera.Up;
	}
	if (glfwGetKey(window, GLFW_KEY_LEFT_CONTROL) == GLFW_PRESS)
	{
		camera.Position += speed * -camera.Up;
	}
}
