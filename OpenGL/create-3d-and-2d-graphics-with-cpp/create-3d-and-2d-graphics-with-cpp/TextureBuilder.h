#ifndef TEXTURE_BUILDER_CLASS_H
#define TEXTURE_BUILDER_CLASS_H

#include<glad/glad.h>
#include<stb/stb_image.h>

#include"ShaderProgram.h"
#include"Texture.h"

class TextureBuilder
{
public:
	GLuint ID;
	GLenum textureType;
	TextureBuilder(const char* image, GLenum texType, GLenum slot);

	void Format(GLenum format, GLenum pixelType);
	Texture Build();
	void TexUnit(ShaderProgram& shader, const char* uniform, GLuint unit);
	void Bind();
	void Unbind();
	void Delete();
};
#endif