package com.company.optimizing_for_latency;

import javax.imageio.ImageIO;
import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Logger;

public class ImageProcessingExample {

    public static final String SOURCE_FILE = "./resources/many-flowers.jpg";
    public static final String DESTINATION_FILE = "./out/purple-flowers.jpg";
    private static final int BYTE = 8;

    public static void main(String[] args) throws IOException {
        var originalImage = ImageIO.read(new File(SOURCE_FILE));
        var resultImage = new BufferedImage(
                originalImage.getWidth(), originalImage.getHeight(), BufferedImage.TYPE_INT_RGB
        );

        long startTime = System.currentTimeMillis();
//        recolorSingleThreaded(originalImage, resultImage);

        int numberOfThreads = 1;
        recolorMultiThreaded(originalImage, resultImage, numberOfThreads);
        long endTime = System.currentTimeMillis();

        long duration = endTime - startTime;

        var fileOutput = new File(DESTINATION_FILE);
        ImageIO.write(resultImage, "jpg", fileOutput);

        String msg = String.valueOf(duration);
        Logger.getLogger("abc").info(msg);
    }

    public static void recolorMultiThreaded(
            BufferedImage originalImage, BufferedImage resultImage, int numberOfThreads
    ) {
        int width = originalImage.getWidth();
        int slicedHeight = originalImage.getHeight() / numberOfThreads;

        var threads = new ArrayList<Thread>();
        for(int i = 0; i < numberOfThreads ; i++) {
            final int threadMultiplier = i;

            Thread thread = new Thread(() -> {
                int xOrigin = 0;
                int yOrigin = slicedHeight * threadMultiplier;

                recolorImage(originalImage, resultImage, xOrigin, yOrigin, width, slicedHeight);
            });

            threads.add(thread);
            thread.start();
        }

        for(var t : threads){
            try {
                t.join();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }

    }

    public static void recolorSingleThreaded(BufferedImage originalImage, BufferedImage resultImage) {
        recolorImage(
                originalImage,
                resultImage,
                0,
                0,
                originalImage.getWidth(),
                originalImage.getHeight()
        );
    }

    public static void recolorImage(
            BufferedImage originalImage,
            BufferedImage resultImage,
            int leftCorner,
            int topCorner,
            int width,
            int height
    ) {
        for (int x = leftCorner; x < leftCorner + width && x < originalImage.getWidth(); x++) {
            for (int y = topCorner; y < topCorner + height && y < originalImage.getHeight(); y++) {
                recolorPixel(originalImage, resultImage, x, y);
            }
        }
    }

    public static void recolorPixel(BufferedImage originalImage, BufferedImage resultImage, int x, int y) {
        int rgb = originalImage.getRGB(x, y);

        int red = getRed(rgb);
        int green = getGreen(rgb);
        int blue = getBlue(rgb);

        int newRed = red;
        int newGreen = green;
        int newBlue = blue;

        if (isShadeOfGray(red, green, blue)) {
            newRed = Math.min(255, red + 10);
            newGreen = Math.max(0, green - 80);
            newBlue = Math.max(0, blue - 20);
        }

        int newRGB = createRGBFromColors(newRed, newGreen, newBlue);
        setRGB(resultImage, x, y, newRGB);
    }

    public static void setRGB(BufferedImage image, int x, int y, int rgb) {
        image.getRaster().setDataElements(x, y, image.getColorModel().getDataElements(rgb, null));
    }

    public static boolean isShadeOfGray(int red, int green, int blue) {
        return Math.abs(red - green) < 30 && Math.abs(red - blue) < 30 && Math.abs(green - blue) < 30;
    }

    public static int createRGBFromColors(int red, int green, int blue) {
        int rgb = 0;

        rgb |= blue;
        rgb |= green << BYTE;
        rgb |= red << (2 * BYTE);

        rgb |= 0xFF000000;

        return rgb;
    }

    public static int getRed(int rgb) {
        return (rgb & 0x00FF0000) >> (2 * BYTE);
    }

    public static int getGreen(int rgb) {
        return (rgb & 0x0000FF00) >> BYTE;
    }

    public static int getBlue(int rgb) {
        return rgb & 0x000000FF;
    }
}
