# <div align="center"><p> Command Injection, Directory Traversal Vuln, XML external entity injection </p></div>
 ## Họ và tên: Mai Thị Hoàng Yến
 ## Ngày báo cáo: Ngày 17/5/2022
 ### MỤC LỤC
 1. [Command Injection](#1)
 
     1.1 [Khái niệm XSS](#11)
      
     1.2 [Các kiểu khai thác XSS](#12)
 
     1.3 [Khi nào thì XSS sẽ xảy ra](#13)

     1.4 [Cách khắc phục XSS](#14)
      
     1.5 [Cách sử dụng XSS để đánh cắp cookies người dùng](#15)
 
     1.6 [Điều chỉnh các tham số header](#16)

     1.7 [Mô phỏng XSS đánh cắp phiên khi Login vào trang web. Cookie sẽ được điều hướng về 1 host dựng sẵn](#17)
      
     1.8 [Mô phỏng code XSS](#18)
 
     1.9 [Khắc phục code lỗi XSS](#19)
     
 2. [CSRF](#2) 

     2.1 [Khái niệm CSRF](#21)
      
     2.2 [Cách thức tấn công CSRF](#22)
 
     2.3 [Mô phỏng code lỗi CSRF](#23)

     2.4 [Khắc phục code lỗi CSRF](#24)
       
 3. [LFI](#3)

     3.1 [Khái niệm LFI](#31)
      
     3.2 [Cách thức tấn công LFI](#32)
 
     3.3 [Mô phỏng code lỗi LFI](#33)

     3.4 [Khắc phục code lỗi LFI](#34)

  4. [RFI](#4)

     4.1 [Khái niệm RFI](#41)
      
     4.2 [Cách thức tấn công RFI](#42)
 
     4.3 [Mô phỏng code lỗi RFI](#43)

     4.4 [Khắc phục code lỗi RFI](#44)
 
 5. [Các hàm đã sử dụng](#5)
 
### Nội dung báo cáo 
#### 1. Command Injection <a name="1"></a>
<br> 1.1 Khái niệm Command Injection <a name="11"></a></br>
  - Command Injection là kiểu tấn công cho phép mở rộng chức năng mặc định của ứng dụng, thực thi các lệnh hệ thống mà không cần phải chèn mã.
  
 <br> 1.1 Khái niệm Command Injection <a name="11"></a></br>
