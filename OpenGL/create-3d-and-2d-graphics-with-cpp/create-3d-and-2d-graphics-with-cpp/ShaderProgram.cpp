#include"ShaderProgram.h"

std::string ReadFile(const char* filename)
{
	std::ifstream in(filename, std::ios::binary);
	if (in)
	{
		std::string contents;
		in.seekg(0, std::ios::end);
		contents.resize(in.tellg());
		in.seekg(0, std::ios::beg);
		in.read(&contents[0], contents.size());
		in.close();
		return contents;
	}
	throw(errno);
}

ShaderProgram::ShaderProgram(const char* vertexFile, const char* fragmentFile)
{
	std::string vertexCode = ReadFile(vertexFile);
	std::string fragmentCode = ReadFile(fragmentFile);

	// Convert the shader source strings into character arrays
	const char* vertexSource = vertexCode.c_str();
	const char* fragmentSource = fragmentCode.c_str();

	// Create Vertex Shader Object and get its reference
	GLuint vertexShader = glCreateShader(GL_VERTEX_SHADER);
	// Attach Vertex Shader source to the Vertex Shader Object
	glShaderSource(vertexShader, 1, &vertexSource, nullptr);
	// Compile the Vertex Shader into machine code
	glCompileShader(vertexShader);

	CheckCompileErrors(vertexShader, "VERTEX");

	// Create Fragment Shader Object and get its reference
	GLuint fragmentShader = glCreateShader(GL_FRAGMENT_SHADER);
	// Attach Fragment Shader source to the Fragment Shader Object
	glShaderSource(fragmentShader, 1, &fragmentSource, nullptr);
	// Compile the Vertex Shader into machine code
	glCompileShader(fragmentShader);

	CheckCompileErrors(vertexShader, "FRAGMENT");

	ID = glCreateProgram();
	glAttachShader(ID, vertexShader);
	glAttachShader(ID, fragmentShader);
	glLinkProgram(ID);

	CheckCompileErrors(ID, "PROGRAM");

	// Delete the now useless Vertex and Fragment Shader objects
	glDeleteShader(vertexShader);
	glDeleteShader(fragmentShader);
}

void ShaderProgram::Activate()
{
	glUseProgram(ID);
}

void ShaderProgram::Delete()
{
	glDeleteProgram(ID);
}

void ShaderProgram::CheckCompileErrors(unsigned int shader, const char* type)
{
	GLint hasCompiled;
	char infoLog[1024];

	if (type == "PROGRAM")
	{
		glGetProgramiv(shader, GL_COMPILE_STATUS, &hasCompiled);
		if (hasCompiled == GL_FALSE)
		{
			glGetProgramInfoLog(shader, 1024, nullptr, infoLog);
			std::cout << "SHADER_LINKING_ERROR for:" << type << "\n" << infoLog << std::endl;
		}
		return;
	}

	glGetShaderiv(shader, GL_COMPILE_STATUS, &hasCompiled);
	if (hasCompiled == GL_FALSE)
	{
		glGetShaderInfoLog(shader, 1024, nullptr, infoLog);
		std::cout << "SHADER_COMPILATION_ERROR for:" << type << "\n" << infoLog << std::endl;
	}
}