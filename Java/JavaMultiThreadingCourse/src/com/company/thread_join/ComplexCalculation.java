package com.company.thread_join;

import java.math.BigInteger;

public class ComplexCalculation {

    public static void main(String[] args) {
        BigInteger base1 = new BigInteger("4");
        BigInteger power1 = new BigInteger("4");
        BigInteger base2 = new BigInteger("2");
        BigInteger power2 = new BigInteger("2");

        BigInteger result = calculateResult(base1, power1, base2, power2);
        System.out.println(result);
    }

    public static BigInteger calculateResult(BigInteger base1, BigInteger power1, BigInteger base2, BigInteger power2) {
        PowerCalculatingThread t1 = new PowerCalculatingThread(base1, power1);
        PowerCalculatingThread t2 = new PowerCalculatingThread(base2, power2);

        t1.start();
        t2.start();

        try {
            t1.join();
            t2.join();

            return t1.getResult().add(t2.getResult());
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
        return null;
    }

    private static class PowerCalculatingThread extends Thread {
        private BigInteger result = BigInteger.ONE;
        private BigInteger base;
        private BigInteger power;

        public PowerCalculatingThread(BigInteger base, BigInteger power) {
            this.base = base;
            this.power = power;
        }

        @Override
        public void run() {
            while (power.compareTo(BigInteger.ONE) != 0) {
                result = result.multiply(base);
                power = power.subtract(BigInteger.ONE);
            }
        }

        public BigInteger getResult() {
            return result;
        }
    }
}