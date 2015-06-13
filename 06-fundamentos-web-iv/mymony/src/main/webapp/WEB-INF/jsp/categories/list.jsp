<%@ page language="java" contentType="text/html; charset=UTF-8"
         pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core" %>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>MyMony - Categories List</title>
    </head>
    <body>
        <h1>Categories</h1>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <c:forEach var="category" items="${categories}">
                    <tr>
                        <td>${category.id}</td>
                        <td>${category.name}</td>
                        <td>
                            <a href="" value="${category.id}" name="Edit">Edit</a>
                            <a href="" value="${category.id}" name="Delete">Delete</a>
                        </td>
                    </tr>
                </c:forEach>
            </tbody>
        </table>
    </body>
</html>