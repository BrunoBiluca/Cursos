#version 330 core

// Outputs colors in RGBA
out vec4 FragColor;

// Inputs the color from the Vertex Shader
in vec3 color;

void main()
{
	FragColor = vec4(
		1.0F - color.x, 
		1.0F - color.y,
		1.0F - color.z,
		1.0f);
}