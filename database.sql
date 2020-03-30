CREATE DATABASE IF NOT EXISTS videoslaravel;
USE videoslaravel;

CREATE TABLE users(
    id int(255) auto_increment not null,
    role VARCHAR(20),
    name VARCHAR(255),
    surname VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    image VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    remenber_token VARCHAR(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDb;

CREATE TABLE videos(
    id int(255) auto_increment not null,
    user_id int(255) not null,
    title VARCHAR(20),
    description text,
    status VARCHAR(20),
    imagen VARCHAR(255),
    video_path VARCHAR(255),
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_videos PRIMARY KEY(id),
    CONSTRAINT fk_videos_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;

CREATE TABLE comments(
    id int(255) auto_increment not null,
    user_id int(255) not null,
    video_id int(255) not null,
    body text,
    created_at DATETIME,
    updated_at DATETIME,
    CONSTRAINT pk_comment PRIMARY KEY(id),
    CONSTRAINT fk_comment_video FOREIGN KEY(video_id) REFERENCES videos(id),
    CONSTRAINT fk_comment_user FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDb;


