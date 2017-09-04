package main

import (
	"flag"
	"fmt"
	"io"
	"net"
	"os"
)

var host = flag.String("host", "", "host")
var port = flag.String("port", "3334", "port")

func main() {
	flag.Parse()
	var l net.Listener
	var err error
	l, err = net.Listen("tcp", *host+":"+*port)
	if err != nil {
		fmt.Println("Error listening:", err)
		os.Exit(1)
	}
	defer l.Close()
	fmt.Println("Listening on " + *host + ":" + *port)
	for {
		conn, err := l.Accept()
		if err != nil {
			fmt.Println("Error accepting: ", err)
			os.Exit(1)
		}
		//logs an incoming message
		fmt.Printf("Received message %s -> %s \n", conn.RemoteAddr(), conn.LocalAddr())
		// Handle connections in a new goroutine.
		go handleRequest(conn)
	}
}
func handleRequest(conn net.Conn) {
	defer conn.Close()
	var buf = make([]byte, 100)
	fmt.Println("start to read from conn")
	n, err := conn.Read(buf)
	if err != nil {
		fmt.Println("conn read error:", err)
		return
	}
	fmt.Printf("read %d bytes, content is %s\n", n, string(buf[:n]))

	var i int
	var s string
	for i = 0; i < 1000; i++ {
		s += "Golang"
	}
	data := []byte(s)
	n, err = conn.Write(data)
	if err != nil {
		fmt.Printf("写入失败\n")
	}

	// var total int
	// for {
	//     if err != nil {
	//         total += n
	//         fmt.Printf("write %d bytes, error:%s\n", n, err)
	//         break
	//     }
	//     total += n
	//     fmt.Printf("write %d bytes this time, %d bytes in total\n", n, total)
	// }

	for {
		io.Copy(conn, conn)
	}
}

// func (c *conn) Write(b string) (int, error) {
//     if !c.ok() {
//         return 0, syscall.EINVAL
//     }
//     n, err := c.fd.Write(b)
//     if err != nil {
//         err = &OpError{Op: "write", Net: c.fd.net, Source: c.fd.laddr, Addr: c.fd.raddr, Err: err}
//     }
//     return n, err
// }
