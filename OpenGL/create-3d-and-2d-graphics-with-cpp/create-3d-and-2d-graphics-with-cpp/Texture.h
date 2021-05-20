#ifndef TEXTURE_CLASS_H
#define TEXTURE_CLASS_H

#include<glad/glad.h>
#include<stb/stb_image.h>

#include"ShaderProgram.h"

class Texture
{
public:
	GLuint ID;
	GLenum textureType;
	Texture(const char* image, GLenum texType, GLenum slot, GLenum format, GLenum pixelType);

	void TexUnit(ShaderProgram& shader, const char* uniform, GLuint unit);
	void Bind();
	void Unbind();
	void Delete();
};
#endif