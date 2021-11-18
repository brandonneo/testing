package com.webTest.app;

// import com.gargoylesoftware.htmlunit.SilentCssErrorHandler;
import java.io.ByteArrayOutputStream;
import java.io.PrintStream;
import org.junit.Before;
import org.junit.Test;
import org.junit.After;
import static org.junit.Assert.*;

import org.openqa.selenium.By;
import org.openqa.selenium.Keys;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.htmlunit.HtmlUnitDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

/**
 * Integration UI test for PHP App.
 */
public class AppTest
{
	WebDriver driver; 
	WebDriverWait wait; 
	String url = "https://eyd0t.sitict.net/login_modal.php";
	String validEmail = "hi@hi.hi";
	String validPassword = "Misterboi@123";
	String invalidEmail = "hi@hi";
	String invalidPassword = "password";

    @Before
    public void setUp() { 
		driver = new HtmlUnitDriver();
		// driver.setCssErrorHandler(new SilentCssErrorHandler());
		wait = new WebDriverWait(driver, 10); 
	} 

	@After
    public void tearDown() { 
		driver.quit(); 
	}	 
	
    @Test
    public void testLoginWithValidEmailValidPassword() 
		throws InterruptedException { 

		//get web page
		driver.get(url);
		//wait until page is loaded or timeout error
		wait.until(ExpectedConditions.titleContains("Login Page")); 

		//enter input
		driver.findElement(By.linkText("I have an account")).sendKeys(Keys.ENTER);
		WebElement email_field = wait.until(ExpectedConditions.elementToBeClickable(By.name("loginemail")));
		email_field.sendKeys(validEmail);
		//driver.findElement(By.name("loginemail")).sendKeys(validEmail);
		WebElement pass_field = driver.findElement(By.name("loginPassword"));
		pass_field.sendKeys(validPassword);
		//click submit
		WebElement submit_btn = driver.findElement(By.name("loginSubmit"));
		submit_btn.submit();
	
		//check result 
		String expectedResult = "Welcome back to EYD0T"; 
		boolean isResultCorrect = wait.until(ExpectedConditions.titleContains(expectedResult)); 
		assertTrue(isResultCorrect == true); 
	}
		
	@Test
    public void testLoginWithValidEmailInvalidPassword() 
		throws InterruptedException { 

		//get web page
		driver.get(url);
		//wait until page is loaded or timeout error
		wait.until(ExpectedConditions.titleContains("Login Page")); 

		//enter input
		driver.findElement(By.linkText("I have an account")).sendKeys(Keys.ENTER);
		WebElement email_field = wait.until(ExpectedConditions.elementToBeClickable(By.name("loginemail")));
		email_field.sendKeys(validEmail);
		//driver.findElement(By.name("loginemail")).sendKeys(validEmail);
		WebElement pass_field = driver.findElement(By.name("loginPassword"));
		pass_field.sendKeys(invalidPassword);
		//click submit
		WebElement submit_btn = driver.findElement(By.name("loginSubmit"));
		submit_btn.submit();
	
		//check result
		// By errorMsgId = By.className("error-msg");
		String expectedResult = "Login Unsuccessful"; 
		WebElement result = driver.findElement(By.xpath("//*[text()='Login Failed']"));
		boolean isResultCorrect = result.getText() != "";
		// boolean isResultCorrect = wait.until(ExpectedConditions.textToBe(errorMsgId, expectedResult)); 
		assertTrue(isResultCorrect == true); 
	}

	@Test
    public void testLoginWithInvalidEmailInvalidPassword() 
		throws InterruptedException { 

		//get web page
		driver.get(url);
		//wait until page is loaded or timeout error
		wait.until(ExpectedConditions.titleContains("Login Page")); 

		//enter input
		driver.findElement(By.linkText("I have an account")).sendKeys(Keys.ENTER);
		WebElement email_field = wait.until(ExpectedConditions.elementToBeClickable(By.name("loginemail")));
		email_field.sendKeys(invalidEmail);
		//driver.findElement(By.name("loginemail")).sendKeys(validEmail);
		WebElement pass_field = driver.findElement(By.name("loginPassword"));
		pass_field.sendKeys(invalidPassword);
		//click submit
		WebElement submit_btn = driver.findElement(By.name("loginSubmit"));
		submit_btn.submit();
	
		//check result
		// By errorMsgId = By.className("error-msg");
		String expectedResult = "Login Unsuccessful"; 
		WebElement result = driver.findElement(By.xpath("//*[text()='Login Failed']"));
		boolean isResultCorrect = result.getText() != "";
		// boolean isResultCorrect = wait.until(ExpectedConditions.textToBe(errorMsgId, expectedResult)); 
		assertTrue(isResultCorrect == true); 
	}

}
