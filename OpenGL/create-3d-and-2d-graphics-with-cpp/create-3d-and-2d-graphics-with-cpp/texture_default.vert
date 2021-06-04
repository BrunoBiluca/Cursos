#version 330 core

// Positions/Coordinates
layout (location = 0) in vec3 aPos;
// Colors
layout (location = 1) in vec3 aColor;
// Texture Coordinates
layout (location = 2) in vec2 aTex;

uniform float scale;

// Outputs the color for the Fragment Shader
out vec3 color;
// Outputs the texture coordinates to the fragment shader
out vec2 texCoord;

// Inputs the matrices needed for 3D viewing with perspective
uniform mat4 cameraView;

uniform mat4 model;


void main()
{
	gl_Position = cameraView * model * vec4(
		aPos.x * scale, 
		aPos.y * scale, 
		aPos.z * scale, 
		1.0
	);

	color = aColor;

	texCoord = aTex;
}