USE `b00652935`;

CREATE TABLE `ProjectUsers` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `username` varchar(20) NOT NULL UNIQUE,
 `password` varchar(255) NOT NULL,
 `reg_date` datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ProjectMovies` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `title` varchar(50) NOT NULL,
 `overview` varchar(500) NOT NULL,
 `poster_path` varchar(50),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ProjectGenres` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `api_id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ProjectUserMovies` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `movie_id` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES ProjectUsers(id),
  FOREIGN KEY (movie_id) REFERENCES ProjectMovies(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ProjectMovieGenres` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `movie_id` int(11) NOT NULL,
 `genre_id` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (movie_id) REFERENCES ProjectMovies(id),
  FOREIGN KEY (genre_id) REFERENCES ProjectGenres(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `ProjectUserGenres` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `genre_id` int(11) NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (user_id) REFERENCES ProjectUsers(id),
  FOREIGN KEY (genre_id) REFERENCES ProjectGenres(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
