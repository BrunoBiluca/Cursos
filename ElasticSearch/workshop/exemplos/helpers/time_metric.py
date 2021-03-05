import time


def time_metric(name):
    def wrapper(func):
        def inner(*args, **kwargs):
            start = time.time()
            res = func(*args, **kwargs)
            end = time.time()
            print(f"Time for {name}: {end - start}")
            return res
        return inner
    return wrapper    