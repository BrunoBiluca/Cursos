package com.company.vault_example;

import java.util.ArrayList;
import java.util.Random;
import java.util.logging.Logger;

public class Main {

    public static final int MAX_PASSWORD = 9999;

    private static final Logger logger = Logger.getLogger("abc");

    public static void main(String[] args){
        var randomPassword = new Random().nextInt(MAX_PASSWORD);

        String msg = "Password is " + randomPassword;
        logger.info(msg);

        var vault = new Vault(randomPassword);

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
                Thread.currentThread().interrupt();
            }
            return guess == this.password;
        }
    }

    private abstract static class HackerThread extends Thread {
        protected Vault vault;

        public HackerThread(Vault vault) {
            this.vault = vault;
            this.setName(this.getClass().getSimpleName());
            this.setPriority(Thread.MAX_PRIORITY);
        }

        @Override
        public synchronized void start() {
            logger.info("Starting thread " + this.getName());
            super.start();
        }

        @Override
        public abstract void run();
    }

    private static class AscendingHackerThread extends HackerThread {
        public AscendingHackerThread(Vault vault) {
            super(vault);
        }

        @Override
        public void run() {
            for(var guess = 0; guess < MAX_PASSWORD; guess++){
                if(this.vault.isCorrectPassword(guess)){
                    String msg = this.getName() + " guessed the password " + guess;
                    logger.info(msg);
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
                    String msg = this.getName() + " guessed the password " + guess;
                    logger.info(msg);
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
                    String msg = String.valueOf(i);
                    logger.info(msg);
                } catch (InterruptedException e) {
                    Thread.currentThread().interrupt();
                }
            }
            logger.info("Game over for you hackers");
        }
    }

}
