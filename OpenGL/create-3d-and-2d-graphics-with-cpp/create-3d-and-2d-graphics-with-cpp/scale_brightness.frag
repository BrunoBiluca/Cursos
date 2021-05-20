#version 330 core

// Outputs colors in RGBA
out vec4 FragColor;

// Inputs the color from the Vertex Shader
in vec3 color;

uniform float brightnessScale;

void main()
{
	FragColor = vec4(
		color.x * brightnessScale, 
		color.y * brightnessScale, 
		color.z * brightnessScale, 
		1.0f
	);
}