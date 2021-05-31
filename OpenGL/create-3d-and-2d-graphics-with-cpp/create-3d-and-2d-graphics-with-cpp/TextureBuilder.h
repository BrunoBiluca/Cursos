//#ifndef TEXTURE_BUILDER_CLASS_H
//#define TEXTURE_BUILDER_CLASS_H
//
//#include<glad/glad.h>
//#include<stb/stb_image.h>
//
//#include"ShaderProgram.h"
//
//class TextureBuilder
//{
//public:
//	TextureBuilder(const char* image, GLenum texType, GLenum slot);
//
//	TextureBuilder Format(GLenum format, GLenum pixelType);
//	TextureBuilder BorderColor(float* color);
//	TextureBuilder ClampToBorder();
//	TextureBuilder& Repeat();
//	void Build();
//
//	void TexUnit(ShaderProgram& shader, const char* uniform, GLuint unit);
//	void Bind();
//	void Unbind();
//	void Delete();
//};
//#endif