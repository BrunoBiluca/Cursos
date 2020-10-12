import math


if __name__ == "__main__":

    def pythagoras_theorem(player, enemy):
        c = math.sqrt(
            abs(player[0] - enemy[0]) ** 2
            + abs(player[1] - enemy[1]) ** 2
        )
        return c

    player = (0, 0)
    enemy = (1, 0)
    distance = pythagoras_theorem(player, enemy)
    print(f"{player} - {enemy} [distance]: {distance}")
    assert distance == 1.0
    
    player = (0, 0)
    enemy = (1, 1)
    distance = pythagoras_theorem(player, enemy)
    print(f"{player} - {enemy} [distance]: {distance}")
    assert distance == 1.4142135623730951
