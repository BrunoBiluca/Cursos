package com.company.semaphore;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.Semaphore;
import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class SemaphoreExample {
    public static void main(String [] args){
        int numberOfThreads = 4; //or any number you'd like

        List<Thread> threads = new ArrayList<>();

        Barrier barrier = new Barrier(numberOfThreads);
        for (int i = 0; i < numberOfThreads; i++) {
            threads.add(new Thread(new CoordinatedWorkRunner(barrier)));
        }

        for(Thread thread: threads) {
            thread.start();
        }
    }

    public static class Barrier {
        private final int numberOfWorkers;

        // We initialize the semaphore to 0,
        // to make sure every thread that tries to acquire the semaphore gets blocked.
        // And the last thread to get to the barrier,
        // releases the semaphore numberOfWorkers - 1 since "numberOfWorkers - 1"
        // threads are blocked on the semaphore.
        private final Semaphore semaphore = new Semaphore(0);

        private final Lock lock = new ReentrantLock();

        private int counter = 0;

        public Barrier(int numberOfWorkers) {
            this.numberOfWorkers = numberOfWorkers;
        }

        public void barrier() {
            lock.lock();
            boolean isLastWorker = false;
            try {
                counter++;

                if (counter == numberOfWorkers) {
                    isLastWorker = true;
                }
            } finally {
                lock.unlock();
            }

            if (isLastWorker) {
                semaphore.release(numberOfWorkers - 1);
            } else {
                try {
                    semaphore.acquire();
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                }
            }
        }
    }

    public static class CoordinatedWorkRunner implements Runnable {
        private final Barrier barrier;

        public CoordinatedWorkRunner(Barrier barrier) {
            this.barrier = barrier;
        }

        @Override
        public void run() {
            try {
                task();
            } catch (InterruptedException exception) {
                Thread.currentThread().interrupt();
            }
        }

        private void task() throws InterruptedException {
            // Performing Part 1
            System.out.println(Thread.currentThread().getName()
                + " part 1 of the work is finished");

            barrier.barrier();
            // Performing Part2
            System.out.println(Thread.currentThread().getName()+ " part 2 of the work is finished");
        }
    }
}
