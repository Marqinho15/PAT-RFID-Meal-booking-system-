Imports MySql.Data.MySqlClient



Public Class Form6
    Dim ServerString As String = "Server=localhost;User Id=root;Password=;Database=rfid"
    Dim SQLConnection As MySqlConnection = New MySqlConnection
    Private Sub Label1_Click(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub
    Private Sub Form6_Load(sender As Object, e As EventArgs) Handles MyBase.Load
    End Sub
   

    Private Sub cmdSearch_Click(sender As Object, e As EventArgs) Handles cmdSearch.Click
        Dim queryString As String = _
        "SELECT nome_a From Alunos Where rfid_a='" & Txtrfid.Text & "'"
        Dim Nome As String
        Dim Data1 As Date = Date.Today
        Dim Data2 As String
        Data2 = Format(Data1, "yyyy-MM-dd")

        SQLConnection.ConnectionString = ServerString
        Dim command As New MySqlCommand(queryString, SQLConnection)
            SQLConnection.Open()

        Dim reader As MySqlDataReader = command.ExecuteReader()


            ' Call Read before accessing data.
            While reader.Read()
                Nome = reader("nome_A").ToString

            End While
            If (Nome = "") Then
                MsgBox("Ninguem")
        End If

        MsgBox(Nome & vbCrLf & Data2)
        SQLConnection.Close()



    End Sub

    Private Sub txtrfid_TextChanged(sender As Object, e As EventArgs) Handles Txtrfid.TextChanged

    End Sub

    Private Sub Button1_Click(sender As Object, e As EventArgs) Handles cmdSearch.Click

    End Sub

    Private Sub Label1_Click_1(sender As Object, e As EventArgs) Handles Label1.Click

    End Sub

    Private Sub TextBox1_TextChanged(sender As Object, e As EventArgs) Handles Txtrfid.TextChanged

    End Sub
End Class