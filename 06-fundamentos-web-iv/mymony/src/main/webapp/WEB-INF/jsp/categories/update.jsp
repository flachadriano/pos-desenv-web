<%@ page language="java" contentType="text/html; charset=UTF-8"
	pageEncoding="UTF-8"%>
<%@ taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Edit category</title>
</head>

<body>
	<form action="<c:url value="${category.id}"/>" method="POST">
		Name: <input type="text" name="category.name" value="${category.name}" /><br />
		<input type="submit" value="Update" />
	</form>
</body>

</html>