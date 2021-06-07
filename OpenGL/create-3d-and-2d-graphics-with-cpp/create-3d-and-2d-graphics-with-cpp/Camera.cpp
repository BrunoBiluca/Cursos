#include "Camera.h"


Camera::Camera(int width, int height, glm::vec3 position)
	: perspectiveWidth(width),
	perspectiveHeight(height),
	Position(position)
{}

void Camera::SetupPerspectiveView(
	float FOVdeg,
	float nearPlane,
	float farPlane
)
{
	glm::mat4 view = glm::mat4(1.0f);
	glm::mat4 projection = glm::mat4(1.0f);

	view = glm::lookAt(Position, Position + Orientation, Up);

	projection = glm::perspective(
		glm::radians(FOVdeg),
		(float)perspectiveWidth / (float)perspectiveHeight,
		nearPlane,
		farPlane
	);

	cameraMatrix = projection * view;
}

void Camera::ExportMatrix(ShaderProgram& shader, const char* uniform)
{
	glUniformMatrix4fv(
		glGetUniformLocation(shader.ID, uniform),
		1,
		GL_FALSE,
		glm::value_ptr(cameraMatrix)
	);
}