CREATE DATABASE hackathon;
GO

USE hackathon;

CREATE TABLE admin (temp NVARCHAR(255) NULL);

CREATE TABLE flag ( flag VARCHAR(255) NOT NULL);

INSERT INTO flag (flag) VALUES ('HDBH{pl4y_w1th_mSSql_s3rv3r_2984a9b27169ae95d8ab005bb2df5924}');


CREATE TABLE notes (
    note_id UNIQUEIDENTIFIER NOT NULL DEFAULT NEWID(),
    title NVARCHAR(255) NOT NULL,
    content NVARCHAR(MAX) NOT NULL,
    created_by NVARCHAR(100) NOT NULL,
    created_at DATETIME NOT NULL DEFAULT GETDATE(),
    CONSTRAINT PK_notes PRIMARY KEY (note_id)
);

INSERT INTO notes (title, content, created_by)
VALUES 
(N'Học SQL cơ bản', N'Ôn lại các câu lệnh CREATE, SELECT, INSERT, UPDATE, DELETE trong SQL Server.', N'Nguyễn Văn A'),

(N'Ý tưởng CTF Challenge', N'Thiết kế một challenge về SQL Injection để kiểm tra kỹ năng khai thác.', N'Trần Thị B'),

(N'Ghi chú học ExpressJS', N'Tìm hiểu cách tạo REST API bằng ExpressJS, kết nối với MSSQL.', N'Lê Văn C'),

(N'Ghi chú bảo mật', N'Xem lại cách ngăn chặn IDOR bằng cách filter theo userEmail.', N'Phạm Thị D'),

(N'Kế hoạch Hackathon 2025', N'Thiết lập MSSQL server, tạo database hackathon và chuẩn bị dataset.', N'Ngô Văn E');
