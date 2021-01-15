package com.company.vault_example;

import java.util.ArrayList;
import java.util.Random;

public class Main {

    public static final int MAX_PASSWORD = 9999;

    public static void main(String[] args){
        var randomPassword = new Random();
        var vault = new Vault(randomPassword.nextInt());

        var threads = new ArrayList<Thread>();
        threads.add(new AscendingHackerThread(vault));
        threads.add(new DescendingHackerThread(vault));
        threads.add(new PoliceThread());

        for(var thread : threads){
            thread.start();
        }
    }

    private static class Vault {
        private final int password;

        public Vault(int password) {
            this.password = password;
        }

        public boolean isCorrectPassword(int guess){
            try {
                Thread.sleep(5);
            } catch (InterruptedException ignored){
                // empty block
            }
            return guess == this.password;
        }
    }

    private static abstract class HackerThread extends Thread {
        protected Vault vault;

        public HackerThread(Vault vault) {
            this.vault = vault;
            this.setName(this.getClass().getSimpleName());
            this.setPriority(Thread.MAX_PRIORITY);
        }

        @Override
        public synchronized void start() {
            System.out.println("Starting thread " + this.getName());
            super.start();
        }
    }

    private static class AscendingHackerThread extends HackerThread {
        public AscendingHackerThread(Vault vault) {
            super(vault);
        }

        @Override
        public void run() {
            for(var guess = 0; guess < MAX_PASSWORD; guess++){
                if(this.vault.isCorrectPassword(guess)){
                    System.out.println(this.getName() + " guessed the password " + guess);
                    System.exit(0);
                }
            }
        }
    }

    private static class DescendingHackerThread extends HackerThread {
        public DescendingHackerThread(Vault vault) {
            super(vault);
        }

        @Override
        public void run() {
            for(var guess = MAX_PASSWORD; guess >= 0; guess--){
                if(this.vault.isCorrectPassword(guess)){
                    System.out.println(this.getName() + " guessed the password " + guess);
                    System.exit(0);
                }
            }
        }
    }

    private static class PoliceThread extends Thread {
        @Override
        public void run() {
            for(var i = 10; i > 0; i--){
                try {
                    Thread.sleep(1000);
                } catch (InterruptedException e) {
                    // empty block
                }
                System.out.println(i);
            }
            System.out.println("Game over for you hackers");
        }
    }

}
