#include<glad/glad.h>
#include<stb/stb_image.h>

#include"ShaderProgram.h"

class TextureBuilder
{

public:

	GLuint ID;
	const char* textureType;
	GLuint unit;

	unsigned char* imageBytes;
	int widthImg, heightImg, numColorChannel;

	TextureBuilder(const char* image, const char* texType, GLenum slot)
	{
		// Assigns the type of the texture ot the texture object
		textureType = texType;

		stbi_set_flip_vertically_on_load(true);
		imageBytes = stbi_load(image, &widthImg, &heightImg, &numColorChannel, 0);

		glGenTextures(1, &ID);
		// Assigns the texture to a Texture Unit
		glActiveTexture(GL_TEXTURE0 + slot);
		unit = slot;
		glBindTexture(GL_TEXTURE_2D, ID);

		// Configures the type of algorithm that is used to make the image smaller or bigger
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MIN_FILTER, GL_NEAREST);
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_MAG_FILTER, GL_NEAREST);

		float flatColor[] = { 0.8F, 0.76F, 0.7F, 1.0F };
		glTexParameterfv(GL_TEXTURE_2D, GL_TEXTURE_BORDER_COLOR, flatColor);
	}

	TextureBuilder& Format(GLenum format, GLenum pixelType)
	{
		// Assigns the image to the OpenGL Texture object
		glTexImage2D(GL_TEXTURE_2D, 0, GL_RGBA, widthImg, heightImg, 0, format, pixelType, imageBytes);
		return *this;
	}

	TextureBuilder& BorderColor(float* color)
	{
		glTexParameterfv(GL_TEXTURE_2D, GL_TEXTURE_BORDER_COLOR, color);
		return *this;
	}

	TextureBuilder& ClampToBorder()
	{
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_CLAMP_TO_BORDER);
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_CLAMP_TO_BORDER);
		return *this;
	}

	TextureBuilder& Repeat()
	{
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_S, GL_REPEAT);
		glTexParameteri(GL_TEXTURE_2D, GL_TEXTURE_WRAP_T, GL_REPEAT);
		return *this;
	}

	TextureBuilder& Build()
	{
		glGenerateMipmap(GL_TEXTURE_2D);

		// Deletes the image data as it is already in the OpenGL Texture object
		stbi_image_free(imageBytes);

		glBindTexture(GL_TEXTURE_2D, 0);

		return *this;
	}

	void TexUnit(ShaderProgram& shader, const char* uniform, GLuint unit)
	{
		GLuint texUni = glGetUniformLocation(shader.ID, uniform);
		shader.Activate();
		glUniform1i(texUni, unit);
	}

	void Bind()
	{
		glActiveTexture(GL_TEXTURE0 + unit);
		glBindTexture(GL_TEXTURE_2D, ID);
	}

	void Unbind()
	{
		glBindTexture(GL_TEXTURE_2D, 0);
	}

	void Delete()
	{
		glDeleteTextures(1, &ID);
	}
};