package com.company.optimizing_for_throughput;

import com.sun.net.httpserver.HttpServer;

import java.io.IOException;
import java.net.InetSocketAddress;
import java.nio.file.Files;
import java.nio.file.Paths;
import java.util.concurrent.Executors;

public class HttpServerExample {

    private static final String INPUT_FILE = "./resources/war_and_peace.txt";
    private static final int NUMBER_OF_THREADS = 6;

    public static void main(String[] args) throws IOException {
        var text = new String(Files.readAllBytes(Paths.get(INPUT_FILE)));
        startServer(text);
    }

    private static void startServer(String text) throws IOException {
        var server = HttpServer.create(new InetSocketAddress(8000), 0);
        server.createContext("/search", new WordHandler(text));

        var threadPool = Executors.newFixedThreadPool(NUMBER_OF_THREADS);
        server.setExecutor(threadPool);
        server.start();
    }
}
