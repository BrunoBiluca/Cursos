package com.company.synchorization;

import java.util.Comparator;

public class MinMaxMetrics {

    private volatile long min;
    private volatile long max;

    /**
     * Initializes all member variables
     */
    public MinMaxMetrics() {
        min = Long.MAX_VALUE;
        max = Long.MIN_VALUE;
    }

    /**
     * Adds a new sample to our metrics.
     */
    public synchronized void addSample(long newSample) {
        max = Math.max(newSample, max);
        min = Math.min(newSample, min);
    }

    /**
     * Returns the smallest sample we've seen so far.
     */
    public long getMin() {
        return min;
    }

    /**
     * Returns the biggest sample we've seen so far.
     */
    public long getMax() {
        return max;
    }
}
