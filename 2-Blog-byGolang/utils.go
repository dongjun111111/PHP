package main

import (
	"net/smtp"
	"os"
	"path/filepath"
	"strings"
	"time"
)

const (
	MAXLOGFILES = 7
)

func sendMail(user, password, host, to, subject, body, mailtype string) error {
	hp := strings.Split(host, ":")
	auth := smtp.PlainAuth("", user, password, hp[0])
	var content_type string
	if mailtype == "html" {
		content_type = "Content-Type: text/" + mailtype + "; charset=UTF-8;"
	} else {
		content_type = "Content-Type: text/plain" + "; charset=UTF-8;"
	}

	msg := []byte("To: " + to + "\r\nFrom: " + user + "<" + user + ">\r\nSubject: " + subject + "\r\n" + content_type + "\r\n" + body)
	send_to := strings.Split(to, ";")
	err := smtp.SendMail(host, auth, user, send_to, msg)
	return err
}

func writeMainLogToFile(vals []string, outfile string) error {
	today := time.Now().Format("2006-01-02")
	if strings.Contains(outfile, today) {
		_, err := os.Open(outfile)
		if err != nil && os.IsNotExist(err) {
			_, err := os.Create(outfile)
			if err != nil {
				panic(err)
			}

		}
	} else {
		panic("data error!")
	}

	f, err := os.OpenFile(outfile, os.O_APPEND, 0644)
	if err != nil {
		panic(err)
	}
	defer f.Close()

	for _, v := range vals {
		v = "Time: " + time.Now().Format("2006-01-02 15:04:05") + "   " + v
		f.WriteString(v)
		f.WriteString("\r\n")
	}
	return err
}

func checkLog(logname string) {
	var i int
	var pathslice []string
	filepath.Walk("log", func(path string, info os.FileInfo, err error) error {
		if !info.IsDir() && filepath.Ext(path) == ".log" && strings.Contains(path, logname) {
			i++
			pathslice = append(pathslice, path)
		}
		return err
	})
	if i > MAXLOGFILES {
		delpathslice := pathslice[:len(pathslice)-MAXLOGFILES]
		for i := 0; i < len(delpathslice); i++ {
			err := os.RemoveAll(delpathslice[i])
			if err != nil {
				println("delet dir error:", err)
				return
			}
			println(delpathslice[i], "--->删除成功")
		}

		//将要发送邮件的内容
		currenttime := time.Now().Format("2006-01-02 15:04:05")
		user := "user@163.com"
		password := "pop3pwd"
		host := "smtp.163.com:25"
		to := "email@qq.com"
		subject := "博客冗余日志文件删除通知"
		var delpathstring string
		for i := 0; i < len(delpathslice); i++ {
			delpathstring += delpathslice[i] + "<br>"
		}
		body := `
            <html>
            <body>
            <h3>
            日志文件删除通知!
            </h3>
            <p>以下文件被删除：</p>
            <p>` + delpathstring + `</p>
            <p>` + currenttime + `</p>
            </body>
            </html>
            `
		println("sending email......")
		err1 := sendMail(user, password, host, to, subject, body, "html")
		if err1 != nil {
			println("sended mail error!")
			println(err1)
		} else {
			println("sended mail success!")
		}
	}
}
