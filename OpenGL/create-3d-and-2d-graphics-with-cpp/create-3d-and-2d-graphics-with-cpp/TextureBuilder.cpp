#include<glad/glad.h>
#include<stb/stb_image.h>

#include"ShaderProgram.h"

class TextureBuilder
{

public:

	GLuint ID;
	GLenum textureType;
	unsigned char* imageBytes;
	int widthImg, heightImg, numColorChannel;

	TextureBuilder(const char* image, GLenum texType, GLenum slot)
	{
		// Assigns the type of the texture ot the texture object
		textureType = texType;

		stbi_set_flip_vertically_on_load(true);
		imageBytes = stbi_load(image, &widthImg, &heightImg, &numColorChannel, 0);

		glGenTextures(1, &ID);
		// Assigns the texture to a Texture Unit
		glActiveTexture(slot);
		glBindTexture(texType, ID);

		// Configures the type of algorithm that is used to make the image smaller or bigger
		glTexParameteri(texType, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
		glTexParameteri(texType, GL_TEXTURE_MAG_FILTER, GL_NEAREST);

		float flatColor[] = { 0.8F, 0.76F, 0.7F, 1.0F };
		glTexParameterfv(GL_TEXTURE_2D, GL_TEXTURE_BORDER_COLOR, flatColor);
	}

	TextureBuilder& Format(GLenum format, GLenum pixelType)
	{
		// Assigns the image to the OpenGL Texture object
		glTexImage2D(textureType, 0, GL_RGBA, widthImg, heightImg, 0, format, pixelType, imageBytes);
		return *this;
	}

	TextureBuilder& BorderColor(float* color)
	{
		glTexParameterfv(GL_TEXTURE_2D, GL_TEXTURE_BORDER_COLOR, color);
		return *this;
	}

	TextureBuilder& ClampToBorder()
	{
		glTexParameteri(textureType, GL_TEXTURE_WRAP_S, GL_CLAMP_TO_BORDER);
		glTexParameteri(textureType, GL_TEXTURE_WRAP_T, GL_CLAMP_TO_BORDER);
		return *this;
	}

	TextureBuilder& Repeat()
	{
		glTexParameteri(textureType, GL_TEXTURE_WRAP_S, GL_REPEAT);
		glTexParameteri(textureType, GL_TEXTURE_WRAP_T, GL_REPEAT);
		return *this;
	}

	TextureBuilder& Build()
	{
		glGenerateMipmap(textureType);

		// Deletes the image data as it is already in the OpenGL Texture object
		stbi_image_free(imageBytes);

		// Unbinds the OpenGL Texture object so that it can't accidentally be modified
		glBindTexture(textureType, 0);

		return *this;
	}

	void TexUnit(ShaderProgram& shader, const char* uniform, GLuint unit)
	{
		// Gets the location of the uniform
		GLuint texUni = glGetUniformLocation(shader.ID, uniform);
		// Shader needs to be activated before changing the value of a uniform
		shader.Activate();
		// Sets the value of the uniform
		glUniform1i(texUni, unit);
	}

	void Bind()
	{
		glBindTexture(textureType, ID);
	}

	void Unbind()
	{
		glBindTexture(textureType, 0);
	}

	void Delete()
	{
		glDeleteTextures(1, &ID);
	}
};