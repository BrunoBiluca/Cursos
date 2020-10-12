import math


def pythagoras_theorem(vector):
    c = math.sqrt(
        vector[0] ** 2 + vector[1] ** 2
    )
    return c


if __name__ == "__main__":
    # TODO: cálculo da soma de vetores
    def result_vector(*vectors):
        composition = (vectors[0][0], vectors[0][1])
        for v in vectors[1:]:
            composition = (
                composition[0] + v[0],
                composition[1] + v[1]
            )

        return {
            'x': composition[0],
            'y': composition[1],
            'magnitude': pythagoras_theorem(composition)
        }

    vector_1 = (0, 0)
    vector_2 = (1, 1)
    vector_3 = (1, -1)
    vector_4 = (1, 0)
    result = result_vector(vector_1, vector_2, vector_3, vector_4)

    print('                       ')
    print('     *(2)              ')
    print('                       ')
    print('*(i)______*(3)__*(f)___>')
    print('---------------->(3, 0)')
    print('result vector', result)
    print('')
    print('')

    def normalize(vector):
        normalized_x = vector[0] / pythagoras_theorem(vector)
        normalized_y = vector[1] / pythagoras_theorem(vector)
        return {
            'x': normalized_x,
            'y': normalized_y,
            'magnitude': pythagoras_theorem((normalized_x, normalized_y))
        }

    original_vector = (10, 10)
    vector_normalized = normalize(original_vector)

    print("original - ", original_vector)
    print("normalized - ", vector_normalized)
