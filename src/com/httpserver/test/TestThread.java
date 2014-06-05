package com.httpserver.test;

import java.util.concurrent.ExecutorService;
import java.util.concurrent.Executors;

public class TestThread {

	/**
	 * @param args
	 */
	public static void main(String[] args) {
		System.out.println("main-->"+Thread.currentThread().getId());
		ExecutorService executor = Executors.newSingleThreadExecutor();
		for(int i=0;i < 100;i ++){
			executor.submit(new Runnable(){
				@Override
				public void run() {
					try {
						Thread.sleep(1);
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
					System.out.println(Thread.currentThread().getId());
				}
			});
			
		}
		executor.submit(new Runnable(){
			@Override
			public void run() {
//				String s = null;
//				System.out.println("exception"+s.length());
			}
		});
		for(int i=0;i < 100;i ++){
			executor.submit(new Runnable(){
				@Override
				public void run() {
					try {
						Thread.sleep(1);
					} catch (InterruptedException e) {
						e.printStackTrace();
					}
					System.out.println(Thread.currentThread().getId());
				}
			});
			
		}
	}

}
