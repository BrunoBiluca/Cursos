#include<glad/glad.h>
#include<GLFW/glfw3.h>

#pragma once

int run02();

GLFWwindow* CreateWindow();

void SceneLoop(GLFWwindow* window, GLuint shaderProgram, GLuint VAO);

GLuint CreateShaderProgram();