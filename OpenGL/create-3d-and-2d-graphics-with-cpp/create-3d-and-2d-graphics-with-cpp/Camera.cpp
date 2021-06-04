#include "Camera.h"


Camera::Camera(int width, int height, glm::vec3 position) 
	: perspectiveWidth(width), 
	perspectiveHeight(height), 
	Position(position)
{
}

void Camera::Matrix(
	float FOVdeg, 
	float nearPlane, 
	float farPlane, 
	ShaderProgram& shader, 
	const char* uniform
)
{
	glm::mat4 view = glm::mat4(1.0f);
	glm::mat4 projection = glm::mat4(1.0f);

	view = glm::lookAt(Position, Position + Orientation, Up);

	projection = glm::perspective(
		glm::radians(FOVdeg), 
		(float)perspectiveWidth / (float)perspectiveHeight,
		nearPlane, 
		farPlane);

	glUniformMatrix4fv(
		glGetUniformLocation(shader.ID, uniform), 
		1, 
		GL_FALSE, 
		glm::value_ptr(projection * view)
	);
}
