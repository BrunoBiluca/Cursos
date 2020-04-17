import scala.annotation.tailrec;

def factorial_recursive(n: Int, acc: Int = 1): Int =
  if (n == 0) acc else n * factorial_recursive(n - 1)

@tailrec
def factorial_tailrec(n: Int, acc: Int = 1): Int = 
  if (n == 0) acc else factorial_tailrec(n -1, n * acc)

def factorial_iteractive(n: Int, initial_value: Int = 1): Int = {
  var acc = initial_value
  for(i <- n until 0 by - 1){
    acc *= i
  }
  return acc
}


def sum_tailrec(f: (Int, Int) => Int, index: Int, end: Int): Int = {
  @tailrec
  def loop(idx: Int, acc: Int): Int =
    if (idx > end) acc
    else loop(idx + 1, acc + f(idx, 1))
  loop(index, 0)
}

def sum_iteractive(f: (Int, Int) => Int, index: Int, end: Int): Int = {
  var acc = 0
  for(i <- 0 to (end - index)){
    acc += f(i, 1)
  }
  return acc
}

factorial_recursive(3)
factorial_tailrec(3)
factorial_iteractive(3)

sum_tailrec(factorial_recursive, 0, 3)
sum_tailrec(factorial_tailrec, 0, 3)
sum_tailrec(factorial_iteractive, 0, 3)

sum_iteractive(factorial_recursive, 0, 3)
sum_iteractive(factorial_tailrec, 0, 3)
sum_iteractive(factorial_iteractive, 0, 3)

