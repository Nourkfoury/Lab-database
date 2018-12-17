package Beauty;

import java.beans.Statement;
import java.sql.Connection;
import java.util.Date;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.text.SimpleDateFormat;
import java.util.Scanner;
import javax.naming.spi.DirStateFactory.Result;

import com.mysql.jdbc.PreparedStatement;




public class Project {
	
	
	public static void main(String args[]) throws ClassNotFoundException, SQLException {
		String choice, name,time,date1;
		int decision;  
	    Date date = new Date();   
		Class.forName("com.mysql.jdbc.Driver");
		java.sql.Statement stmt = null;
		Connection conn = null;
		String sql = null;
		String sql1 = null;
		ResultSet rs = null;
		ResultSet rs1=null;
		Scanner scan = new Scanner (System.in);
		
		conn = DriverManager.getConnection("jdbc:mysql://localhost/beauty_company","root","");
		stmt= conn.createStatement();
		
		while (true) {
			System.out.println(date.getYear()+1900+"-"+(date.getMonth()+1)+"-"+date.getDate());
			System.out.println("Enter your email");
			String email= scan.next();
			System.out.println("Enter your password");
			String userpass = scan.next();
			
			sql="Select * FROM users WHERE email='"+email +"'";
			rs= stmt.executeQuery(sql);
			

				if(rs.next()) {
					if(rs.getString("password").equals(userpass)) {
						while (true) {
							System.out.println("1- Display all employess in the company ");
							System.out.println("2- Display the employees who attended today with the time");
							System.out.println("3- Display the employees who did not attende today");
							System.out.println("4- Insert an employee to the attendance sheet");
							System.out.println("5- Add an excuse for an employee");
							System.out.println("6- Exit");
							System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
							System.out.println("Enter your choice:");
							choice=scan.next();
							
							switch(choice) {
							case "1":{
								sql="Select * FROM employees";
								rs= stmt.executeQuery(sql);
								System.out.println("the employees in this company are:");
								System.out.println();
								System.out.println("Name:           Age:    Gender:");
								System.out.println();
								while(rs.next()) {
									System.out.println(rs.getString("name")+"    "+rs.getInt("age")+"    "+rs.getString("gender"));
								}
								System.out.println();
								System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
								System.out.println();
								break;
							}
							
							case"2":{
								int count=0;
								System.out.println("enter the date you wish to see the attendance for (yyyy-mm-dd)");
								date1=scan.next();
								sql="Select employee_id, time_from  FROM attendance WHERE date_attendance='"+date1+"'";
								rs= stmt.executeQuery(sql);
								System.out.println("the employees who attendend today are:");
								System.out.println();
								System.out.println("Name:           time of attendance:");
								System.out.println();
								
								while(rs.next()) {
									time=rs.getString("time_from");
									sql1="Select name FROM employees WHERE id='"+rs.getInt("employee_id")+"'";
									rs1= stmt.executeQuery(sql1);
									if(rs1.next()) {
									System.out.println(rs1.getString("name")+"        "+time);
									}
									count++;
									rs= stmt.executeQuery(sql);
									for(int i=0; i<count;i++) {
										rs.next();
									}
									
								}
								System.out.println();
								System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
								System.out.println();	
								break;
							}
							
							case "3":{
								int count=0;
								System.out.println("enter the date you wish to see the absence for (yyyy-mm-dd)");
								date1=scan.next();
								System.out.println("the employees who did not attend today are:");
								System.out.println();
								System.out.println("Name:           excused?:");
								System.out.println();
								sql="SELECT id,name FROM employees WHERE id NOT IN (Select employee_id FROM attendance WHERE date_attendance='"+date1 +"')";
								rs= stmt.executeQuery(sql);
								
								while(rs.next()) {
									name=rs.getString("name");
									sql1="SELECT id FROM leaves WHERE date_leave='"+date1+"' AND employee_id ='"+rs.getInt("id")
									+"'";
									rs1= stmt.executeQuery(sql1);
									if(rs1.next()) {
										System.out.println(name+"       "+"yes");
									}
									else {
										System.out.println(name+"       "+"no");
									}
									count++;
									rs= stmt.executeQuery(sql);
									for(int i=0; i<count;i++) {
										rs.next();
									}
								}
								System.out.println();
								System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
								System.out.println();	
								break;	
							}
							
							case "4":{
								System.out.println("enter the date  (yyyy-mm-dd)");
								date1=scan.next();
								System.out.println("please enter the time (hh:mm:ss)");
								time=scan.next();
								System.out.println("please enter  the name of the employee");
								name=scan.nextLine();
								name=scan.nextLine();
								System.out.println(name);
								System.out.println(date1);
								System.out.println(time);
								sql="SELECT id FROM employees WHERE name='"+name+"'";
								rs= stmt.executeQuery(sql);
								
								
								if(rs.next()) {
									
								int id=rs.getInt("id");
								String sql2 = "INSERT INTO attendance(date_attendance,time_from,employee_id) VALUES(?,?,?)";
								 
						        try (PreparedStatement pstmt = (PreparedStatement) conn.prepareStatement(sql2)) {
						        	pstmt.setString(1, date1);
						        	pstmt.setString(2, time);
						            pstmt.setInt(3, id);
						            pstmt.executeUpdate();
						        } catch (SQLException e) {
						            System.out.println(e.getMessage());
									System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
									System.out.println();
						            break;
						        }
									System.out.println("");
									System.out.println("Successfully addded");
									System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
									System.out.println();
								}
								else {
									System.out.println("this employee does not exist");
									System.out.println();
									System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
									System.out.println();
									break;
								}
								
								break;
							}
							
							case "5":{
								System.out.println("please enter  the name of the employee");
								name=scan.nextLine();
								name=scan.nextLine();
								System.out.println("please enter the date (yyyy-mm-dd)");
								 date1=scan.nextLine();
								System.out.println("please enter the excuse");
								String reason=scan.nextLine();
								
								sql1="Select id FROM employees WHERE name='"+name+"'";
								rs1= stmt.executeQuery(sql1);
								if(rs1.next()) {
									int id=rs1.getInt("id");
									String sql2 = "INSERT INTO leaves(date_leave,employee_id,reason) VALUES(?,?,?)";
									 
							        try (PreparedStatement pstmt = (PreparedStatement) conn.prepareStatement(sql2)) {
							        	pstmt.setString(1, date1);
							            pstmt.setInt(2, id);
							        	pstmt.setString(3, reason);

							            pstmt.executeUpdate();
							        } catch (SQLException e) {
							            System.out.println(e.getMessage());
										System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
										System.out.println();
							            break;
							        }
									System.out.println("");
									System.out.println("Successfully addded");
									System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
									System.out.println();
								}
								else {
									System.out.println("this employee does not exist");
									System.out.println("~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~");
									System.out.println();
								}
								
								break;
							}
							
							case "6":{
								System.exit(0);
							}
							default:{
								System.out.println();
								System.out.println("Wrong imput! Try again.");
								System.out.println();
								break;
							}
							}
						}
					}
					else System.out.println("wrong pass");
				}
				else {
					System.out.println("this username does not exist");
				}
			}
		
		}
		
		

}