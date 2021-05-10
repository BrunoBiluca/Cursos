#ifndef SHADER_PROGRAM_H
#define SHADER_PROGRAM_H

#include<glad/glad.h>
#include<string>
#include<fstream>
#include<sstream>
#include<iostream>
#include<cerrno>

std::string get_file_contents(const char* filename);

class ShaderProgram
{
public:
	// Reference ID of the Shader Program
	GLuint ID;
	ShaderProgram(const char* vertexFile, const char* fragmentFile);

	void Activate();
	void Delete();
};
#endif